<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<!-- PAGE HEADER -->
<div class="admin-page-header">
   <div>
      <h1 class="page-title">WhatsApp Gateway</h1>
      <div class="breadcrumb">
         <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
         <span class="breadcrumb-sep">›</span>
         <span class="breadcrumb-active">WhatsApp Gateway</span>
      </div>
   </div>
</div>

<div class="row">
   <!-- Left Column: Status and Message Tester -->
   <div class="col-lg-8">
      <!-- MAIN STATUS CARD -->
      <div class="card p-6 mb-6" id="statusCard">
         <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
            <h2 class="text-base font-bold text-gray-800 uppercase tracking-wide">Status Gateway</h2>
            <span id="stateBadge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600">
               <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
               Checking Status...
            </span>
         </div>

         <!-- Status Layout States -->
         
         <!-- State 1: Connecting (Loading spinner) -->
         <div id="stateConnecting" class="text-center py-10" style="display:none;">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto mb-4"></div>
            <p class="text-sm font-semibold text-gray-600">Sedang menghubungkan ke server WhatsApp...</p>
            <p class="text-xs text-gray-400 mt-1">Proses ini memakan waktu beberapa detik.</p>
         </div>

         <!-- State 2: QR Ready (Scan code) -->
         <div id="stateQRReady" class="flex flex-col md:flex-row items-center gap-6 py-4" style="display:none;">
            <div class="p-3 bg-white border-2 border-dashed border-primary/20 rounded-2xl shadow-inner flex items-center justify-center shrink-0 w-[240px] h-[240px] mx-auto md:mx-0">
               <img id="qrImage" src="" alt="WhatsApp QR Code" class="w-full h-full object-contain">
            </div>
            <div class="flex-1 text-center md:text-left">
               <h3 class="text-lg font-bold text-gray-900 mb-2">Tautkan Perangkat Anda</h3>
               <p class="text-sm text-gray-500 leading-relaxed mb-4">Pindai QR code di samping menggunakan aplikasi WhatsApp untuk menghubungkan gateway absensi sekolah dengan akun WhatsApp Anda.</p>
               
               <ol class="text-xs text-gray-600 text-left list-decimal pl-4 space-y-2 max-w-md mx-auto md:mx-0 mb-4">
                  <li>Buka <strong>WhatsApp</strong> di handphone Anda.</li>
                  <li>Ketuk <strong>Menu</strong> (titik tiga) atau <strong>Pengaturan</strong> dan pilih <strong>Perangkat Tertaut</strong>.</li>
                  <li>Ketuk <strong>Tautkan Perangkat</strong> dan arahkan kamera ke layar ini.</li>
               </ol>
               
               <span class="inline-flex items-center gap-2 text-xs font-semibold text-amber-600 bg-amber-50 border border-amber-100 px-3 py-1 rounded-lg">
                  <i class="material-icons text-[14px]">refresh</i>
                  QR Code otomatis terbarui setiap 20 detik jika belum dipindai.
               </span>
            </div>
         </div>

         <!-- State 3: Connected (Active Session details) -->
         <div id="stateConnected" class="py-4" style="display:none;">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 p-5 bg-emerald-50/50 border border-emerald-100 rounded-2xl">
               <div class="flex items-center gap-4 text-center sm:text-left">
                  <div class="w-14 h-14 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg">
                     <i class="material-icons text-[28px]">phonelink_ring</i>
                  </div>
                  <div>
                     <h3 class="text-base font-bold text-gray-900 mb-1" id="sessionName">Nama Perangkat</h3>
                     <p class="text-xs font-semibold text-emerald-700 bg-emerald-100/60 border border-emerald-200/80 px-2 py-0.5 rounded-md inline-block" id="sessionNumber">Nomor HP</p>
                  </div>
               </div>
               <button onclick="logoutSession()" class="btn btn-outline border-red-200 bg-red-50 hover:bg-red-100 text-red-600 shadow-sm font-semibold py-2.5 px-5 rounded-xl flex items-center gap-2 self-stretch sm:self-auto justify-center">
                  <i class="material-icons">logout</i>
                  Putuskan Sesi Perangkat
               </button>
            </div>
         </div>

         <!-- State 4: Offline (Gateway process down) -->
         <div id="stateOffline" class="text-center py-8" style="display:none;">
            <div class="w-16 h-16 mx-auto mb-4 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center border border-rose-100 shadow-inner">
               <i class="material-icons text-[32px]">wifi_off</i>
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-2">WhatsApp Gateway Offline</h3>
            <p class="text-xs text-gray-500 max-w-md mx-auto leading-relaxed mb-6" id="offlineErrorMsg">Gagal berkomunikasi dengan proses WhatsApp Gateway pada port 3000. Pastikan server Node.js sudah dinyalakan.</p>
            
            <div class="bg-gray-50 rounded-xl p-4 text-left font-mono text-xs text-gray-600 border border-gray-100 max-w-lg mx-auto leading-relaxed">
               <div class="text-gray-400 mb-1"># Jalankan perintah berikut di terminal:</div>
               <span class="text-primary font-bold">cd whatsapp-gateway</span><br>
               <span class="text-primary font-bold">npm start</span>
            </div>
         </div>
      </div>

      <!-- MESSAGE TESTER CARD -->
      <div class="card p-6" id="messageTesterCard" style="display:none;">
         <div class="border-b border-gray-100 pb-4 mb-5">
            <h2 class="text-base font-bold text-gray-800 uppercase tracking-wide">Uji Coba Pengiriman Pesan</h2>
         </div>
         
         <form id="testMessageForm" onsubmit="sendTestMessage(event)">
            <div class="row">
               <div class="col-md-6 mb-4">
                  <label class="form-label font-semibold text-gray-700 text-xs uppercase mb-2">Nomor HP Penerima</label>
                  <input type="text" id="testNumber" class="form-control focus:ring-4 focus:ring-primary/10 rounded-xl p-3 border-gray-200 text-sm placeholder:text-gray-400" placeholder="Contoh: 081234567890 atau 6281234567890" required>
                  <span class="text-[10px] text-gray-400 mt-1.5 block">Format internasional (awalan 62) atau format lokal (awalan 0) didukung.</span>
               </div>
               <div class="col-md-6 mb-4">
                  <label class="form-label font-semibold text-gray-700 text-xs uppercase mb-2">Pesan Uji Coba</label>
                  <textarea id="testMessage" class="form-control focus:ring-4 focus:ring-primary/10 rounded-xl p-3 border-gray-200 text-sm placeholder:text-gray-400" rows="3" placeholder="Tulis pesan uji coba di sini..." required>Ini adalah pesan uji coba dari Dashboard Sistem Absensi Sekolah SMP PGRI 1 CIPUTAT.</textarea>
               </div>
            </div>

            <div class="flex justify-end pt-2">
               <button type="submit" id="btnSendTest" class="btn btn-primary shadow-md font-semibold py-2.5 px-6 rounded-xl flex items-center gap-2">
                  <i class="material-icons">send</i>
                  Kirim Pesan Tes
               </button>
            </div>
         </form>
      </div>
   </div>

   <!-- Right Column: Info & Operational Guide -->
   <div class="col-lg-4">
      <div class="card p-6 mb-6">
         <div class="flex items-center gap-3 mb-4 border-b border-gray-100 pb-3">
            <i class="material-icons text-primary">info_outline</i>
            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Integrasi Notifikasi</h3>
         </div>
         <p class="text-xs text-gray-500 leading-relaxed mb-4">
            WhatsApp Gateway bertindak sebagai jembatan untuk mengirimkan notifikasi absensi masuk dan keluar secara otomatis kepada orang tua siswa.
         </p>
         <div class="p-3.5 bg-purple-50 border border-purple-100 rounded-xl text-[11px] leading-relaxed text-purple-700">
            <strong class="block mb-1 text-purple-900">⚙️ Status Notifikasi:</strong>
            Sistem saat ini dikonfigurasi untuk mengirim pesan secara real-time saat barcode di-tap pada terminal scan kehadiran.
         </div>
      </div>

      <div class="card p-6">
         <div class="flex items-center gap-3 mb-4 border-b border-gray-100 pb-3">
            <i class="material-icons text-primary">terminal</i>
            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Panduan Sesi</h3>
         </div>
         <ul class="space-y-3.5 text-xs text-gray-500 leading-relaxed pl-0" style="list-style: none;">
            <li class="flex gap-2.5 items-start">
               <i class="material-icons text-emerald-500 text-[16px] shrink-0 mt-0.5">check_circle_outline</i>
               <span>Sesi WhatsApp aman tersimpan secara lokal pada server Node.js di folder <code>whatsapp-gateway/auth_info_baileys</code>.</span>
            </li>
            <li class="flex gap-2.5 items-start">
               <i class="material-icons text-indigo-500 text-[16px] shrink-0 mt-0.5">sync</i>
               <span>Apabila koneksi tidak stabil, dashboard akan secara otomatis mencoba menyambungkan ulang tanpa perlu campur tangan admin.</span>
            </li>
            <li class="flex gap-2.5 items-start">
               <i class="material-icons text-rose-500 text-[16px] shrink-0 mt-0.5">info_outline</i>
               <span>Jika Anda memutus sesi (logout), kredensial lama akan dibersihkan seluruhnya dari disk untuk mencegah penyalahgunaan sesi.</span>
            </li>
         </ul>
      </div>
   </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
   let pollInterval = null;
   let isProcessing = false;

   $(document).ready(function() {
      // Mulai polling status
      checkStatus();
      pollInterval = setInterval(checkStatus, 3000);
   });

   function updateBadge(state) {
      const badge = $('#stateBadge');
      badge.removeClass('bg-emerald-100 text-emerald-700 border border-emerald-200 bg-amber-100 text-amber-700 border border-amber-200 bg-blue-100 text-blue-700 border border-blue-200 bg-rose-100 text-rose-700 border border-rose-200');
      
      switch(state) {
         case 'connected':
            badge.addClass('bg-emerald-100 text-emerald-700 border border-emerald-200');
            badge.html('<span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Terhubung');
            break;
         case 'qr_ready':
            badge.addClass('bg-amber-100 text-amber-700 border border-amber-200');
            badge.html('<span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Butuh Scan QR');
            break;
         case 'connecting':
            badge.addClass('bg-blue-100 text-blue-700 border border-blue-200');
            badge.html('<span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> Menghubungkan');
            break;
         default:
            badge.addClass('bg-rose-100 text-rose-700 border border-rose-200');
            badge.html('<span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Putus / Offline');
      }
   }

   function checkStatus() {
      if (isProcessing) return;

      $.ajax({
         url: '<?= base_url("admin/whatsapp/status"); ?>',
         type: 'GET',
         dataType: 'json',
         success: function(res) {
            if (res.status === false) {
               // Gateway offline
               showState('offline');
               $('#offlineErrorMsg').text(res.message);
            } else {
               updateBadge(res.state);
               
               if (res.state === 'connected') {
                  showState('connected');
                  $('#sessionName').text(res.user.name);
                  $('#sessionNumber').text('+' + res.user.id.split('@')[0]);
               } else if (res.state === 'qr_ready') {
                  showState('qr_ready');
                  if (res.qr) {
                     $('#qrImage').attr('src', res.qr);
                  }
               } else if (res.state === 'connecting') {
                  showState('connecting');
               } else {
                  showState('offline');
               }
            }
         },
         error: function() {
            showState('offline');
            $('#offlineErrorMsg').text('Gagal menghubungi backend admin server absensi sekolah.');
         }
      });
   }

   function showState(state) {
      $('#stateConnecting').hide();
      $('#stateQRReady').hide();
      $('#stateConnected').hide();
      $('#stateOffline').hide();
      
      updateBadge(state);

      if (state === 'connecting') {
         $('#stateConnecting').show();
         $('#messageTesterCard').hide();
      } else if (state === 'qr_ready') {
         $('#stateQRReady').show();
         $('#messageTesterCard').hide();
      } else if (state === 'connected') {
         $('#stateConnected').show();
         $('#messageTesterCard').show();
      } else if (state === 'offline') {
         $('#stateOffline').show();
         $('#messageTesterCard').hide();
      }
   }

   function logoutSession() {
      swal({
         title: "Putuskan WhatsApp?",
         text: "Apakah Anda yakin ingin memutuskan perangkat dan keluar dari sesi aktif saat ini?",
         icon: "warning",
         buttons: {
            cancel: "Batalkan",
            confirm: {
               text: "Ya, Putuskan Sesi",
               value: true,
               visible: true,
               className: "btn-danger"
            }
         },
         dangerMode: true,
      }).then((willLogout) => {
         if (willLogout) {
            isProcessing = true;
            showState('connecting');
            
            $.ajax({
               url: '<?= base_url("admin/whatsapp/logout"); ?>',
               type: 'POST',
               dataType: 'json',
               data: {
                  '<?= csrf_token() ?>': '<?= csrf_hash(); ?>'
               },
               success: function(res) {
                  isProcessing = false;
                  if (res.status === true) {
                     swal("Sesi Terputus", "Kredensial sesi lama berhasil dibersihkan dari penyimpanan.", "success");
                  } else {
                     swal("Gagal Logout", res.message || "Gagal memutuskan sesi perangkat.", "error");
                  }
                  checkStatus();
               },
               error: function() {
                  isProcessing = false;
                  swal("Gagal Logout", "Koneksi ke server terputus.", "error");
                  checkStatus();
               }
            });
         }
      });
   }

   function sendTestMessage(e) {
      e.preventDefault();
      
      const number = $('#testNumber').val().trim();
      const message = $('#testMessage').val().trim();
      const btn = $('#btnSendTest');

      if (!number || !message) return;

      btn.prop('disabled', true).html('<div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white inline-block"></div> Mengirim...');

      $.ajax({
         url: '<?= base_url("admin/whatsapp/test-send"); ?>',
         type: 'POST',
         dataType: 'json',
         data: {
            'number': number,
            'message': message,
            '<?= csrf_token() ?>': '<?= csrf_hash(); ?>'
         },
         success: function(res) {
            btn.prop('disabled', false).html('<i class="material-icons">send</i> Kirim Pesan Tes');
            if (res.status === true) {
               swal("Pesan Terkirim", "Pesan uji coba telah sukses diteruskan ke perangkat penerima.", "success");
               $('#testNumber').val('');
            } else {
               swal("Gagal Mengirim", res.message || "Gagal mengirimkan pesan uji coba.", "error");
            }
         },
         error: function() {
            btn.prop('disabled', false).html('<i class="material-icons">send</i> Kirim Pesan Tes');
            swal("Gagal Mengirim", "Koneksi ke backend admin server terputus.", "error");
         }
      });
   }
</script>
<?= $this->endSection() ?>
