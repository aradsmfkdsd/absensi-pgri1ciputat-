<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Kiosk Absensi Sekolah RFID - SMP PGRI 1 CIPUTAT">
   <meta name="theme-color" content="#7C3AED">
   <title><?= $title ?? 'Kiosk Absensi' ?></title>
   
   <!-- Google Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
   
   <!-- Material Icons -->
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

   <style>
      :root {
         --primary: #7C3AED;
         --primary-light: #C084FC;
         --primary-dark: #6D28D9;
         --success: #10B981;
         --success-soft: #ECFDF5;
         --danger: #EF4444;
         --danger-soft: #FEF2F2;
         --warning: #F59E0B;
         --warning-soft: #FFFBEB;
         --bg-gradient: linear-gradient(135deg, #0F172A 0%, #1E1B4B 100%);
         --glass-bg: rgba(255, 255, 255, 0.03);
         --glass-border: rgba(255, 255, 255, 0.08);
         --text-main: #F8FAFC;
         --text-muted: #94A3B8;
      }

      * {
         box-sizing: border-box;
         margin: 0;
         padding: 0;
      }

      body {
         font-family: 'Inter', sans-serif;
         background: var(--bg-gradient);
         color: var(--text-main);
         min-height: 100vh;
         overflow: hidden;
         display: flex;
         flex-direction: column;
         position: relative;
      }

      /* Background decorative glows */
      body::before {
         content: '';
         position: absolute;
         width: 500px;
         height: 500px;
         background: radial-gradient(circle, rgba(124, 58, 237, 0.15) 0%, transparent 70%);
         top: -100px;
         left: -100px;
         z-index: 0;
         pointer-events: none;
      }

      body::after {
         content: '';
         position: absolute;
         width: 600px;
         height: 600px;
         background: radial-gradient(circle, rgba(192, 132, 252, 0.1) 0%, transparent 70%);
         bottom: -150px;
         right: -150px;
         z-index: 0;
         pointer-events: none;
      }

      /* Layout Container */
      .kiosk-container {
         position: relative;
         z-index: 1;
         flex: 1;
         display: flex;
         flex-direction: column;
         padding: 32px;
         height: 100vh;
         max-width: 1600px;
         margin: 0 auto;
         width: 100%;
      }

      /* Header */
      .kiosk-header {
         display: flex;
         align-items: center;
         justify-content: space-between;
         margin-bottom: 24px;
         padding-bottom: 20px;
         border-bottom: 1px solid var(--glass-border);
      }

      .logo-section {
         display: flex;
         align-items: center;
         gap: 16px;
      }

      .logo-icon {
         width: 48px;
         height: 48px;
         background: var(--primary);
         border-radius: 12px;
         display: flex;
         align-items: center;
         justify-content: center;
         box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
      }

      .logo-icon i {
         font-size: 26px;
         color: white;
      }

      .school-title h1 {
         font-family: 'Outfit', sans-serif;
         font-size: 22px;
         font-weight: 800;
         letter-spacing: -0.02em;
         line-height: 1.1;
      }

      .school-title p {
         font-size: 11px;
         color: var(--text-muted);
         text-transform: uppercase;
         letter-spacing: 0.1em;
         font-weight: 600;
         margin-top: 2px;
      }

      /* Live Clock */
      .clock-section {
         text-align: right;
      }

      .live-time {
         font-family: 'Outfit', sans-serif;
         font-size: 32px;
         font-weight: 700;
         color: white;
         line-height: 1;
      }

      .live-date {
         font-size: 13px;
         color: var(--text-muted);
         font-weight: 500;
         margin-top: 4px;
      }

      /* Main Content Grid */
      .kiosk-grid {
         flex: 1;
         display: grid;
         grid-template-columns: 1fr 1.2fr;
         gap: 32px;
         min-height: 0; /* Ensures proper overflow scrolling */
         align-items: stretch;
      }

      /* Left Side: Scan controls */
      .control-panel {
         background: var(--glass-bg);
         border: 1px solid var(--glass-border);
         border-radius: 24px;
         padding: 40px;
         display: flex;
         flex-direction: column;
         justify-content: space-between;
         box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
         backdrop-filter: blur(20px);
      }

      .welcome-message h2 {
         font-family: 'Outfit', sans-serif;
         font-size: 36px;
         font-weight: 800;
         margin-bottom: 12px;
         line-height: 1.1;
         background: linear-gradient(to right, #ffffff, var(--primary-light));
         -webkit-background-clip: text;
         -webkit-text-fill-color: transparent;
      }

      .welcome-message p {
         font-size: 15px;
         color: var(--text-muted);
         line-height: 1.6;
      }

      /* Scanning Area */
      .scanning-box {
         margin: 40px 0;
         text-align: center;
         position: relative;
      }

      .status-badge {
         display: inline-flex;
         align-items: center;
         gap: 10px;
         padding: 12px 24px;
         border-radius: 100px;
         font-size: 14px;
         font-weight: 700;
         border: 1px solid rgba(255,255,255,0.08);
         background: rgba(0,0,0,0.2);
         margin-bottom: 24px;
         transition: all 0.3s ease;
      }

      .status-badge.connected {
         color: var(--success);
         border-color: rgba(16, 185, 129, 0.2);
         box-shadow: 0 0 20px rgba(16, 185, 129, 0.1);
      }

      .status-badge.disconnected {
         color: var(--danger);
         border-color: rgba(239, 68, 68, 0.2);
         box-shadow: 0 0 20px rgba(239, 68, 68, 0.1);
      }

      .status-badge i {
         font-size: 18px;
      }

      .status-badge .ping-glow {
         width: 8px;
         height: 8px;
         border-radius: 50%;
         display: inline-block;
      }
      
      .status-badge.connected .ping-glow {
         background: var(--success);
         animation: pulse-green 1.5s infinite;
      }

      .status-badge.disconnected .ping-glow {
         background: var(--danger);
         animation: pulse-red 1.5s infinite;
      }

      @keyframes pulse-green {
         0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
         70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
         100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
      }

      @keyframes pulse-red {
         0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
         70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
         100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
      }

      .scan-input-container {
         position: relative;
         max-width: 400px;
         margin: 0 auto;
      }

      .kiosk-input {
         width: 100%;
         background: rgba(0, 0, 0, 0.4);
         border: 2px solid var(--glass-border);
         border-radius: 18px;
         padding: 20px;
         color: white;
         font-size: 24px;
         font-weight: 700;
         text-align: center;
         letter-spacing: 0.1em;
         transition: all 0.3s ease;
         outline: none;
      }

      .kiosk-input:focus {
         border-color: var(--primary);
         box-shadow: 0 0 30px rgba(124, 58, 237, 0.25);
      }

      .scan-instruction-text {
         font-size: 13px;
         color: var(--text-muted);
         margin-top: 16px;
         font-weight: 500;
      }

      /* Switch Mode Button Container */
      .mode-toggle-section {
         display: flex;
         gap: 16px;
      }

      .mode-btn {
         flex: 1;
         border-radius: 16px;
         padding: 18px;
         font-size: 15px;
         font-weight: 700;
         cursor: pointer;
         border: 1px solid var(--glass-border);
         display: flex;
         align-items: center;
         justify-content: center;
         gap: 10px;
         transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
         text-transform: uppercase;
         letter-spacing: 0.05em;
      }

      .mode-btn.inactive {
         background: rgba(255, 255, 255, 0.02);
         color: var(--text-muted);
      }

      .mode-btn.inactive:hover {
         background: rgba(255, 255, 255, 0.05);
         color: white;
      }

      .mode-btn.masuk-active {
         background: linear-gradient(135deg, #059669 0%, #10B981 100%);
         color: white;
         border: none;
         box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
      }

      .mode-btn.pulang-active {
         background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%);
         color: white;
         border: none;
         box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
      }

      /* Right Side: Scan Result Display Panel */
      .result-panel {
         background: var(--glass-bg);
         border: 1px solid var(--glass-border);
         border-radius: 24px;
         padding: 40px;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
         backdrop-filter: blur(20px);
         position: relative;
         overflow: hidden;
         transition: all 0.4s ease;
      }

      /* Empty state graphic */
      .empty-state-view {
         text-align: center;
         display: flex;
         flex-direction: column;
         align-items: center;
         gap: 20px;
         max-width: 420px;
         transition: opacity 0.3s ease;
      }

      .empty-icon {
         width: 140px;
         height: 140px;
         border-radius: 50%;
         background: rgba(255, 255, 255, 0.02);
         border: 2px dashed rgba(255, 255, 255, 0.1);
         display: flex;
         align-items: center;
         justify-content: center;
         margin-bottom: 8px;
         position: relative;
      }

      .empty-icon i {
         font-size: 64px;
         color: rgba(255, 255, 255, 0.15);
         animation: float 4s ease-in-out infinite;
      }

      @keyframes float {
         0%, 100% { transform: translateY(0); }
         50% { transform: translateY(-10px); }
      }

      .empty-state-view h3 {
         font-family: 'Outfit', sans-serif;
         font-size: 24px;
         font-weight: 700;
         color: white;
      }

      .empty-state-view p {
         font-size: 14px;
         color: var(--text-muted);
         line-height: 1.6;
      }

      /* Dynamic scan result styles (loaded via ajax) */
      .kiosk-result-content {
         width: 100%;
         height: 100%;
         display: flex;
         flex-direction: column;
         justify-content: center;
      }

      /* Custom result wrappers for style matching */
      .kiosk-result-card {
         width: 100%;
         animation: scaleUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      @keyframes scaleUp {
         0% { transform: scale(0.9); opacity: 0; }
         100% { transform: scale(1); opacity: 1; }
      }

      .kiosk-result-header {
         text-align: center;
         margin-bottom: 32px;
      }

      .kiosk-result-header h3 {
         font-family: 'Outfit', sans-serif;
         font-size: 28px;
         font-weight: 800;
      }

      .text-success {
         color: var(--success) !important;
      }

      .text-danger {
         color: var(--danger) !important;
      }

      .text-warning {
         color: var(--warning) !important;
      }

      .profile-info-grid {
         display: grid;
         grid-template-columns: 140px 1fr;
         gap: 32px;
         background: rgba(255, 255, 255, 0.02);
         border: 1px solid var(--glass-border);
         border-radius: 20px;
         padding: 24px;
         align-items: center;
      }

      .photo-placeholder {
         width: 140px;
         height: 140px;
         border-radius: 16px;
         background: rgba(255,255,255,0.03);
         border: 1px solid var(--glass-border);
         display: flex;
         align-items: center;
         justify-content: center;
         color: var(--text-muted);
         box-shadow: 0 10px 25px rgba(0,0,0,0.2);
         overflow: hidden;
      }

      .photo-placeholder i {
         font-size: 64px;
      }

      .info-details {
         display: flex;
         flex-direction: column;
         gap: 12px;
      }

      .info-details p {
         font-size: 14px;
         color: var(--text-muted);
      }

      .info-details b {
         color: white;
         font-size: 18px;
         margin-left: 8px;
         font-weight: 600;
      }

      .time-row {
         display: flex;
         gap: 24px;
         margin-top: 16px;
         padding-top: 16px;
         border-top: 1px solid var(--glass-border);
      }

      .time-box {
         flex: 1;
         background: rgba(0,0,0,0.15);
         border: 1px solid var(--glass-border);
         border-radius: 12px;
         padding: 12px;
         text-align: center;
      }

      .time-box span {
         font-size: 11px;
         color: var(--text-muted);
         text-transform: uppercase;
         font-weight: 600;
         display: block;
         margin-bottom: 4px;
      }

      .time-box b {
         font-size: 20px;
         font-weight: 700;
         color: var(--primary-light);
      }

      .late-badge {
         margin-top: 24px;
         background: rgba(245, 158, 11, 0.08);
         border: 1px solid rgba(245, 158, 11, 0.2);
         border-radius: 14px;
         padding: 16px 20px;
         display: flex;
         align-items: center;
         gap: 14px;
         color: var(--warning);
         font-weight: 600;
         font-size: 14px;
         animation: shake 0.5s ease-in-out;
      }

      @keyframes shake {
         0%, 100% { transform: translateX(0); }
         20%, 60% { transform: translateX(-6px); }
         40%, 80% { transform: translateX(6px); }
      }

      .late-badge i {
         font-size: 24px;
      }

      /* Kiosk Footer */
      .kiosk-footer {
         text-align: center;
         padding-top: 20px;
         border-top: 1px solid var(--glass-border);
         font-size: 12px;
         color: var(--text-muted);
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      .connection-indicator {
         display: flex;
         align-items: center;
         gap: 6px;
         font-weight: 600;
      }

      .connection-indicator .indicator-dot {
         width: 8px;
         height: 8px;
         border-radius: 50%;
         background: var(--success);
      }
   </style>
</head>
<body>

   <div class="kiosk-container">
      
      <!-- Header Section -->
      <header class="kiosk-header">
         <div class="logo-section">
            <div class="logo-icon">
               <i class="material-icons">contactless</i>
            </div>
            <div class="school-title">
               <h1>SMP PGRI 1 CIPUTAT</h1>
               <p>Smart Attendance Kiosk</p>
            </div>
         </div>
         <div class="clock-section">
            <div class="live-time" id="liveTime">00:00:00</div>
            <div class="live-date" id="liveDate">Senin, 1 Januari 2026</div>
         </div>
      </header>

      <!-- Main Kiosk Grid -->
      <div class="kiosk-grid">
         
         <!-- Control & Input Panel -->
         <div class="control-panel">
            
            <div class="welcome-message">
               <h2>Selamat Datang</h2>
               <p>Silakan tempelkan kartu RFID / Proximity Card Anda pada alat pembaca untuk melakukan pencatatan kehadiran harian.</p>
            </div>

            <!-- RFID Input & Focus status -->
            <div class="scanning-box">
               <div id="statusBadge" class="status-badge connected">
                  <span class="ping-glow"></span>
                  <i class="material-icons" id="statusIcon">usb</i>
                  <span id="statusText">RFID Reader: Siap (Fokus Aktif)</span>
               </div>
               
               <div class="scan-input-container">
                  <input type="text" id="rfidInput" class="kiosk-input" placeholder="TAPPING DISINI" autofocus autocomplete="off">
               </div>
               
               <p class="scan-instruction-text">Sistem auto-focus menjaga koneksi RFID reader secara konstan.</p>
            </div>

            <!-- Mode Selection Toggles -->
            <div class="mode-toggle-section">
               <button id="btnMasuk" class="mode-btn <?= $waktu == 'Masuk' ? 'masuk-active' : 'inactive' ?>" onclick="switchMode('Masuk')">
                  <i class="material-icons">login</i> Absen Masuk
               </button>
               <button id="btnPulang" class="mode-btn <?= $waktu == 'Pulang' ? 'pulang-active' : 'inactive' ?>" onclick="switchMode('Pulang')">
                  <i class="material-icons">logout</i> Absen Pulang
               </button>
            </div>

         </div>

         <!-- Result Display Panel -->
         <div class="result-panel" id="resultPanel">
            
            <!-- Default View -->
            <div class="empty-state-view" id="emptyState">
               <div class="empty-icon">
                  <i class="material-icons">sensors</i>
               </div>
               <h3>Menunggu Tap Kartu...</h3>
               <p>Tempelkan kartu RFID Anda pada pemindai. Hasil pencatatan dan status kehadiran akan langsung ditampilkan di sini.</p>
            </div>

            <!-- AJAX Result Container -->
            <div id="hasilScan" style="width: 100%; display: none;"></div>

         </div>

      </div>

      <!-- Footer Section -->
      <footer class="kiosk-footer">
         <div>&copy; 2026 SMP PGRI 1 CIPUTAT. All rights reserved.</div>
         <div class="connection-indicator">
            <div class="indicator-dot"></div>
            <span>Kiosk Mode Online</span>
         </div>
      </footer>

   </div>

   <!-- JQuery -->
   <script src="<?= base_url('assets/js/core/jquery-3.5.1.min.js') ?>"></script>
   
   <script>
      let currentMode = '<?= $waktu; ?>';
      let clearTimer = null;
      let audio = new Audio("<?= base_url('assets/audio/beep.mp3'); ?>");

      // Live Clock
      function updateClock() {
         const now = new Date();
         
         // Formatting Time
         let hours = String(now.getHours()).padStart(2, '0');
         let minutes = String(now.getMinutes()).padStart(2, '0');
         let seconds = String(now.getSeconds()).padStart(2, '0');
         document.getElementById('liveTime').textContent = `${hours}:${minutes}:${seconds}`;

         // Formatting Date
         const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
         const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
         
         let dayName = days[now.getDay()];
         let date = now.getDate();
         let monthName = months[now.getMonth()];
         let year = now.getFullYear();
         
         document.getElementById('liveDate').textContent = `${dayName}, ${date} ${monthName} ${year}`;
      }

      setInterval(updateClock, 1000);
      updateClock();

      // Switch Kiosk mode (Masuk / Pulang)
      function switchMode(mode) {
         currentMode = mode;
         const btnMasuk = $('#btnMasuk');
         const btnPulang = $('#btnPulang');

         if (mode === 'Masuk') {
            btnMasuk.removeClass('inactive').addClass('masuk-active');
            btnPulang.removeClass('pulang-active').addClass('inactive');
         } else {
            btnPulang.removeClass('inactive').addClass('pulang-active');
            btnMasuk.removeClass('masuk-active').addClass('inactive');
         }
         
         $('#rfidInput').focus();
         resetKioskView();
      }

      // Reset panel view to waiting state
      function resetKioskView() {
         $('#hasilScan').hide().html('');
         $('#emptyState').fadeIn();
         $('#rfidInput').val('');
      }

      // Check Scanned ID Code via AJAX
      async function sendScanData(code) {
         if (clearTimer) clearTimeout(clearTimer);
         
         // Visual loading state
         $('#emptyState').hide();
         $('#hasilScan').html('<div class="empty-state-view"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div><h3>Memproses Presensi...</h3></div>').show();

         jQuery.ajax({
            url: "<?= base_url('scanner/cek'); ?>",
            type: 'post',
            data: { 'unique_code': code, 'waktu': currentMode.toLowerCase() },
            success: function (response) {
               audio.play().catch(e => console.log('Audio autoplay blocked'));
               
               // Wrap custom response inside clean kiosk card styling
               let parsedHtml = formatKioskResult(response);
               $('#hasilScan').html(parsedHtml);
               
               // Auto reset view after 5 seconds
               clearTimer = setTimeout(resetKioskView, 5000);
            },
            error: function (xhr, status, thrown) {
               $('#hasilScan').html('<div class="kiosk-result-card"><div class="kiosk-result-header text-danger"><i class="material-icons" style="font-size: 64px;">error_outline</i><h3>Terjadi Kesalahan</h3><p style="color: var(--text-muted); margin-top:8px;">Koneksi gagal atau kartu tidak valid.</p></div></div>');
               clearTimer = setTimeout(resetKioskView, 5000);
            }
         });
      }

      // Format response to kiosk visual standard
      function formatKioskResult(htmlSnippet) {
         let tempDiv = $('<div>').html(htmlSnippet);
         let title = tempDiv.find('h3').first().text();
         let isSuccess = tempDiv.find('h3').hasClass('text-success') || tempDiv.find('h3').first().text().includes('Berhasil');
         let isWarning = tempDiv.find('h3').hasClass('text-warning') || tempDiv.find('h3').first().text().includes('Terlambat');
         let isError = tempDiv.find('h3').hasClass('text-danger');
         
         let titleClass = 'text-success';
         let iconName = 'check_circle';
         
         if (isWarning) {
            titleClass = 'text-warning';
            iconName = 'warning';
         } else if (isError || !isSuccess) {
            titleClass = 'text-danger';
            iconName = 'error';
         }

         let rows = tempDiv.find('p');
         let detailsHtml = '';
         let timeBoxes = '';

         rows.each(function() {
            let label = $(this).text().split(':')[0].trim();
            let value = $(this).find('b').text().trim();
            
            if (label.includes('Jam masuk') || label.includes('Jam pulang')) {
               timeBoxes += `<div class="time-box"><span>${label}</span><b>${value || '—'}</b></div>`;
            } else {
               detailsHtml += `<p>${label}: <b>${value}</b></p>`;
            }
         });

         let warningNotice = '';
         let warningDiv = tempDiv.find('.mt-4');
         if (warningDiv.length > 0) {
            warningNotice = `<div class="late-badge"><i class="material-icons">alarm</i><span>${warningDiv.text().trim()}</span></div>`;
         }

         return `
            <div class="kiosk-result-card">
               <div class="kiosk-result-header ${titleClass}">
                  <i class="material-icons" style="font-size: 64px; display:block; margin: 0 auto 16px auto;">${iconName}</i>
                  <h3>${title || 'Pencatatan Kehadiran'}</h3>
               </div>
               
               <div class="profile-info-grid">
                  <div class="photo-placeholder">
                     <i class="material-icons">account_circle</i>
                  </div>
                  <div class="info-details">
                     ${detailsHtml}
                  </div>
               </div>

               ${timeBoxes ? `<div class="time-row">${timeBoxes}</div>` : ''}
               ${warningNotice}
            </div>
         `;
      }

      // Input Submission Listener
      $('#rfidInput').on('keypress', function (e) {
         if (e.which == 13) {
            let code = $(this).val().trim();
            if (code.length > 0) {
               sendScanData(code);
               $(this).val('');
            }
         }
      });

      // RFID Connection / Auto-Focus Management
      $(document).ready(function () {
         const rfidInput = $('#rfidInput');
         const statusBadge = $('#statusBadge');
         const statusText = $('#statusText');

         function updateStatus(focused) {
            if (focused) {
               statusBadge.removeClass('disconnected').addClass('connected');
               statusText.text('RFID Reader: Siap (Fokus Aktif)');
            } else {
               statusBadge.removeClass('connected').addClass('disconnected');
               statusText.text('RFID Reader: Tidak Fokus (Klik Disini)');
            }
         }

         rfidInput.on('focus', () => updateStatus(true));
         rfidInput.on('blur', () => {
            updateStatus(false);
            // Re-gain focus instantly to ensure RFID reader always writes to this input field
            setTimeout(() => {
               rfidInput.focus();
            }, 100);
         });

         // Make clicking anywhere on the page refocus the input
         $(document).on('click', () => {
            rfidInput.focus();
         });

         // Initial focus
         rfidInput.focus();
         
         // Auto-mode switching based on clock hours:
         // Before 11:30 AM default to Masuk, after 11:30 AM default to Pulang harian
         const hours = new Date().getHours();
         const minutes = new Date().getMinutes();
         if (hours > 11 || (hours === 11 && minutes >= 30)) {
            switchMode('Pulang');
         } else {
            switchMode('Masuk');
         }
      });
   </script>
</body>
</html>
