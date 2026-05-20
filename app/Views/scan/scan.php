<?= $this->extend('templates/starting_page_layout'); ?>

<?= $this->section('navaction') ?>
<a href="<?= base_url('/admin'); ?>" class="btn btn-outline border-gray-200 bg-white hover:bg-gray-50 text-gray-700">
   <i class="material-icons text-[18px]">dashboard</i>
   <span class="font-medium">Dashboard</span>
</a>

<a href="<?= base_url('/logout'); ?>" class="btn btn-outline border-red-200 bg-red-50 hover:bg-red-100 text-red-600">
   <i class="material-icons text-[18px]">logout</i>
   <span class="font-medium">Logout</span>
</a>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>
<?php
$oppBtn = ($waktu == 'Masuk' ? 'pulang' : 'masuk');
?>

<div class="max-w-[1200px] mx-auto">
   <div class="flex flex-col lg:flex-row gap-8 items-start">
      <!-- Left Section: Scanner -->
      <div class="w-full lg:flex-[2]">
         <div class="card overflow-hidden mb-6 p-0">
            <!-- Card Header -->
            <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
               <div>
                  <div class="flex items-center gap-2 mb-1">
                     <div class="w-2 h-2 rounded-full <?= $waktu == 'Masuk' ? 'bg-green-500' : 'bg-blue-500' ?> animate-pulse"></div>
                     <h2 class="text-lg font-bold text-gray-900">Absensi <?= $waktu; ?></h2>
                  </div>
                  <p class="text-sm text-gray-500">Silakan tempelkan (tap) kartu RFID pada USB Reader yang terhubung</p>
               </div>
               <a href="<?= base_url("scan/$oppBtn"); ?>" class="btn <?= $oppBtn == 'masuk' ? 'btn-primary' : 'bg-blue-600 hover:bg-blue-700 text-white' ?> shadow-sm">
                  <i class="material-icons text-[18px]"><?= $oppBtn == 'masuk' ? 'login' : 'logout' ?></i>
                  SWITCH TO <?= strtoupper($oppBtn); ?>
               </a>
            </div>
            
            <div class="p-6 sm:p-8">
               <!-- RFID Section (Default & Only Mode) -->
               <div id="rfidSection">
                  <div class="text-center bg-gray-50/50 p-8 sm:p-12 rounded-xl border-2 border-dashed border-gray-200 hover:border-primary/50 transition-colors">
                     <div id="rfidStatus" class="mb-6">
                        <span id="statusBadge" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200 transition-colors">
                           <i class="material-icons text-[16px]">usb</i>
                           <span id="statusText">RFID Reader: Siap (Fokus Aktif)</span>
                        </span>
                     </div>
                     <input type="text" id="rfidInput" class="form-control w-full max-w-[320px] mx-auto text-center border-2 border-primary/40 focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-xl py-3 px-4 text-lg font-bold text-primary placeholder:text-gray-300 placeholder:font-medium tracking-widest shadow-sm" placeholder="TAP KARTU DISINI" autofocus autocomplete="off">
                     <p class="text-xs text-gray-400 mt-4 font-medium">Pastikan kotak input tetap aktif saat melakukan tap kartu RFID.</p>
                  </div>
               </div>
            </div>
         </div>

         <!-- Result Area -->
         <div id="hasilScan" class="mt-6 scroll-mt-24"></div>
      </div>

      <!-- Right Section: Info & Tips -->
      <div class="w-full lg:flex-1 lg:sticky lg:top-[104px] space-y-6">
         
         <!-- Instructions Card -->
         <div class="card p-6">
            <div class="flex items-center gap-3 mb-5">
               <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                  <i class="material-icons text-[18px]">help_outline</i>
               </div>
               <h3 class="text-sm font-bold text-gray-800 tracking-wide uppercase">Cara Penggunaan</h3>
            </div>
            
            <ul class="space-y-4">
               <li class="flex gap-4 items-start">
                  <div class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">1</div>
                  <p class="text-sm text-gray-600 leading-relaxed">Pilih mode Masuk atau Pulang menggunakan tombol biru di kanan atas layar.</p>
               </li>
               <li class="flex gap-4 items-start">
                  <div class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">2</div>
                  <p class="text-sm text-gray-600 leading-relaxed">Pastikan status reader menunjukkan "Siap (Fokus Aktif)" dan kursor berada di dalam kotak input.</p>
               </li>
               <li class="flex gap-4 items-start">
                  <div class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">3</div>
                  <p class="text-sm text-gray-600 leading-relaxed">Tempelkan (tap) kartu RFID pada USB Reader. Sistem akan mencatat kehadiran secara seketika.</p>
               </li>
            </ul>
         </div>

         <!-- Tips Card -->
         <div class="card p-6 bg-gradient-to-br from-primary to-purple-600 border-0 shadow-lg text-white">
            <div class="flex items-center gap-3 mb-4 opacity-90">
               <i class="material-icons text-[20px]">contactless</i>
               <h3 class="text-sm font-bold tracking-wide uppercase">Perangkat USB RFID</h3>
            </div>
            <p class="text-sm leading-relaxed opacity-90">Sistem ini dikonfigurasi untuk bekerja secara optimal dengan USB Proximity Card Reader 125kHz (EM4100/TK4100). Saat kartu di-tap, alat akan mengirimkan kode ID dan menekan tombol Enter secara otomatis.</p>
         </div>
         
      </div>
   </div>
</div>

<script src="<?= base_url('assets/js/core/jquery-3.5.1.min.js') ?>"></script>
<script type="text/javascript">
   let audio = new Audio("<?= base_url('assets/audio/beep.mp3'); ?>");

   async function cekData(code) {
      // Show loading state in result area
      $('#hasilScan').html('<div class="card p-8 flex justify-center"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div></div>');
      
      jQuery.ajax({
         url: "<?= base_url('scan/cek'); ?>",
         type: 'post',
         data: { 'unique_code': code, 'waktu': '<?= strtolower($waktu); ?>' },
         success: function (response) {
            audio.play().catch(e => console.log('Audio autoplay blocked by browser'));
            $('#hasilScan').html(response);
            $('html, body').animate({ scrollTop: $("#hasilScan").offset().top - 40 }, 500);
         },
         error: function (xhr, status, thrown) {
            $('#hasilScan').html('<div class="card p-6 bg-red-50 text-red-600 border-red-100"><div class="flex items-center gap-3"><i class="material-icons">error_outline</i><p class="font-medium">Terjadi kesalahan koneksi saat memproses presensi.</p></div></div>');
         }
      });
   }

   // RFID Input Submission Listener
   $('#rfidInput').on('keypress', function (e) {
      if (e.which == 13) {
         let code = $(this).val().trim();
         if (code.length > 0) {
            cekData(code);
            $(this).val('');
         }
      }
   });

   $(document).ready(function () {
      const rfidInput = $('#rfidInput');
      const statusBadge = $('#statusBadge');
      const statusText = $('#statusText');

      function updateStatus(focused) {
         if (focused) {
            statusBadge.removeClass('bg-gray-200 text-gray-600 bg-red-100 text-red-700 border-red-200').addClass('bg-green-100 text-green-700 border border-green-200');
            statusText.text('RFID Reader: Siap (Fokus Aktif)');
         } else {
            statusBadge.removeClass('bg-green-100 text-green-700 border border-green-200').addClass('bg-red-100 text-red-700 border border-red-200');
            statusText.text('RFID Reader: Tidak Fokus (Klik Disini)');
         }
      }

      rfidInput.on('focus', () => updateStatus(true));
      rfidInput.on('blur', () => {
         updateStatus(false);
         setTimeout(() => {
            rfidInput.focus();
         }, 2500);
      });

      $(document).on('click', () => {
         rfidInput.focus();
      });

      rfidInput.focus();
   });
</script>
<?= $this->endSection(); ?>