import makeWASocket, { DisconnectReason, useMultiFileAuthState, fetchLatestBaileysVersion } from '@whiskeysockets/baileys';

import { Boom } from '@hapi/boom';
import qrcode from 'qrcode-terminal';
import QRCode from 'qrcode';
import express from 'express';
import pino from 'pino';
import fs from 'fs';
import path from 'path';

const app = express();
app.use(express.json());

const port = process.env.PORT || 3000;
let sock = null;
let connectionState = 'connecting';
let latestQR = null;

async function connectToWhatsApp() {
    const { state, saveCreds } = await useMultiFileAuthState('auth_info_baileys');
    
    // Ambil versi WA Web terbaru secara dinamis agar tidak terkena error 405 (Method Not Allowed)
    let version = [2, 3000, 1017531287]; // fallback default
    try {
        const { version: waVersion, isLatest } = await fetchLatestBaileysVersion();
        console.log(`[WA-GATEWAY] Menggunakan WA Web v${waVersion.join('.')}, Terbaru: ${isLatest}`);
        version = waVersion;
    } catch (err) {
        console.log('[WA-GATEWAY] Gagal mengambil versi terbaru secara dinamis, menggunakan versi fallback.');
    }
    
    sock = makeWASocket({
        auth: state,
        version,
        printQRInTerminal: false, // Kita cetak sendiri agar tampilannya lebih rapi
        logger: pino({ level: 'silent' }) // matikan log pino agar terminal bersih
    });

    sock.ev.on('connection.update', (update) => {
        const { connection, lastDisconnect, qr } = update;
        
        if (qr) {
            console.log('\n==================================================');
            console.log('   SCAN QR CODE BERIKUT DENGAN APLIKASI WHATSAPP  ');
            console.log('==================================================\n');
            qrcode.generate(qr, { small: true });
            console.log('\nSilakan buka WhatsApp > Perangkat Tertaut > Tautkan Perangkat.');
            
            QRCode.toDataURL(qr)
                .then(url => {
                    latestQR = url;
                })
                .catch(err => {
                    console.error('[WA-GATEWAY] Gagal generate Base64 QR Code:', err.message);
                });
        }
        
        if (connection === 'close') {
            connectionState = 'disconnected';
            latestQR = null;
            const errorReason = lastDisconnect?.error;
            const shouldReconnect = (errorReason instanceof Boom)
                ? errorReason.output?.statusCode !== DisconnectReason.loggedOut
                : true;
            
            console.log(`[WA-GATEWAY] Koneksi terputus karena:`, errorReason);
            console.log(`[WA-GATEWAY] Mencoba menghubungkan kembali: ${shouldReconnect}`);
            if (shouldReconnect) {
                setTimeout(connectToWhatsApp, 5000);
            }
        } else if (connection === 'open') {
            connectionState = 'connected';
            latestQR = null;
            console.log('\n[WA-GATEWAY] WhatsApp Gateway siap digunakan dan terhubung!');
        }
    });

    sock.ev.on('creds.update', saveCreds);
}

// Endpoint untuk mengirim pesan
app.post('/send-message', async (req, res) => {
    const { number, message } = req.body;

    if (!number || !message) {
        return res.status(400).json({
            status: false,
            message: 'Parameter "number" dan "message" wajib diisi.'
        });
    }

    if (connectionState !== 'connected' || !sock) {
        return res.status(503).json({
            status: false,
            message: 'WhatsApp Gateway belum terhubung. Silakan scan QR code terlebih dahulu.'
        });
    }

    try {
        // Bersihkan format nomor HP (hanya ambil angka)
        let formattedNumber = number.replace(/[^0-9]/g, '');

        // Ubah awalan '08' atau '+62' menjadi format internasional '628'
        if (formattedNumber.startsWith('0')) {
            formattedNumber = '62' + formattedNumber.slice(1);
        }

        // Tambahkan suffix WhatsApp
        if (!formattedNumber.endsWith('@s.whatsapp.net')) {
            formattedNumber = formattedNumber + '@s.whatsapp.net';
        }

        // Kirim pesan
        const response = await sock.sendMessage(formattedNumber, { text: message });
        
        console.log(`[WA-GATEWAY] Pesan berhasil dikirim ke ${formattedNumber}`);
        return res.status(200).json({
            status: true,
            message: 'Pesan berhasil dikirim',
            data: response
        });
    } catch (error) {
        console.error('[WA-GATEWAY] Gagal mengirim pesan:', error);
        return res.status(500).json({
            status: false,
            message: 'Gagal mengirim pesan',
            error: error.message
        });
    }
});

// Endpoint untuk status koneksi
app.get('/status', (req, res) => {
    let state = connectionState;
    if (latestQR) {
        state = 'qr_ready';
    }
    
    return res.json({
        status: true,
        state: state,
        qr: latestQR,
        user: sock && sock.user ? {
            id: sock.user.id,
            name: sock.user.name || sock.user.id.split('@')[0]
        } : null
    });
});

// Endpoint untuk logout
app.post('/logout', async (req, res) => {
    try {
        console.log('[WA-GATEWAY] Melakukan logout dan pembersihan sesi...');
        
        if (sock) {
            sock.ev.removeAllListeners('connection.update');
            try {
                await sock.logout();
            } catch (e) {
                console.log('[WA-GATEWAY] Gagal logout socket:', e.message);
            }
            try {
                sock.end();
            } catch (e) {
                // ignore
            }
            sock = null;
        }
        
        connectionState = 'disconnected';
        latestQR = null;

        setTimeout(() => {
            try {
                const authDir = 'auth_info_baileys';
                if (fs.existsSync(authDir)) {
                    fs.rmSync(authDir, { recursive: true, force: true });
                    console.log('[WA-GATEWAY] Folder auth_info_baileys berhasil dihapus.');
                }
            } catch (err) {
                console.error('[WA-GATEWAY] Gagal menghapus folder auth_info_baileys:', err.message);
            }
            
            connectToWhatsApp();
        }, 1000);

        return res.json({
            status: true,
            message: 'Logout berhasil, sesi di-reset.'
        });
    } catch (error) {
        console.error('[WA-GATEWAY] Gagal logout:', error);
        return res.status(500).json({
            status: false,
            message: 'Gagal melakukan logout',
            error: error.message
        });
    }
});

// Jalankan Express Server dan inisialisasi WA Connection
app.listen(port, () => {
    console.log(`[WA-GATEWAY] Server berjalan di http://localhost:${port}`);
    connectToWhatsApp();
});
