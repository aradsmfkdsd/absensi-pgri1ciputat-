<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<?php
/* Map avatar background colour by initial */
if (!function_exists('avatarColor')) {
    function avatarColor($name) {
        $colors = ['#7C3AED','#10B981','#3B82F6','#F59E0B','#EF4444','#8B5CF6','#06B6D4','#F97316'];
        return $colors[ord(strtolower($name[0] ?? 'a')) % count($colors)];
    }
}
?>

<!-- PAGE HEADER (Clean, avoiding MD conflict) -->
<div class="admin-page-header">
   <div>
      <h1 class="page-title">Absensi Siswa</h1>
      <div class="breadcrumb">
         <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
         <span class="breadcrumb-sep">›</span>
         <span class="breadcrumb-active">Absensi Siswa</span>
      </div>
   </div>
</div>

<!-- PREMIUM HERO BANNER -->
<div class="premium-hero-card">
   <div>
      <h2 class="premium-hero-title">Rekap Absensi Siswa</h2>
      <p class="premium-hero-subtitle">Pantau tingkat kehadiran harian, kedisiplinan waktu, dan rekam jejak presensi seluruh kelas secara real-time.</p>
   </div>
   <div class="premium-hero-badge">
      <i class="material-icons" style="font-size: 18px; color: #34D399;">verified</i>
      <span>Sistem Aktif & Terhubung</span>
   </div>
</div>

<!-- FILTER CARD: Kelas + Tanggal -->
<div class="premium-filter-card">
   <div class="flex items-center justify-between" style="margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
      <div class="flex items-center gap-3">
         <div style="width: 44px; height: 44px; border-radius: var(--r-md); background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center;">
            <i class="material-icons" style="font-size: 24px;">class</i>
         </div>
         <div>
            <div style="font-size: 16px; font-weight: 700; color: var(--text-primary);">Pilih Kelas & Tanggal</div>
            <div style="font-size: 13px; color: var(--text-muted); margin-top: 2px;">Klik kelas di bawah untuk memuat rekap kehadiran pada tanggal yang dipilih</div>
         </div>
      </div>
      <!-- Date Picker -->
      <div class="date-picker-btn">
         <i class="material-icons" style="font-size: 18px; color: var(--primary);">calendar_today</i>
         <input type="date" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>" onchange="onDateChange()">
      </div>
   </div>

   <!-- Class Pills -->
   <div style="display: flex; flex-wrap: wrap; gap: 10px;" id="klassPills">
      <?php foreach ($kelas as $value):
         $idKelas   = $value['id_kelas'];
         $namaKelas = $value['kelas'];
      ?>
         <button id="kelas-<?= $idKelas; ?>"
                 onclick="getSiswa(<?= $idKelas; ?>, '<?= esc($namaKelas); ?>')"
                 class="kelas-pill">
            <?= esc($namaKelas); ?>
         </button>
      <?php endforeach; ?>
   </div>
</div>

<!-- DATA TABLE SECTION (loaded via AJAX) -->
<div id="dataSiswa">
   <!-- Empty state -->
   <div class="card" style="text-align: center; padding: 64px 24px; border: 2px dashed #E5E7EB; box-shadow: none;">
      <div style="width: 64px; height: 64px; background: var(--primary-soft); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto;">
         <i class="material-icons" style="font-size: 32px;">school</i>
      </div>
      <div style="font-size: 16px; font-weight: 700; color: var(--text-primary);">Belum Ada Kelas yang Dipilih</div>
      <div style="font-size: 13px; color: var(--text-muted); margin-top: 6px; max-width: 380px; margin-left: auto; margin-right: auto;">Silakan pilih tanggal dan klik salah satu tombol kelas di atas untuk memuat daftar absensi siswa.</div>
   </div>
</div>

<!-- MODAL Ubah Kehadiran -->
<div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Ubah Kehadiran Siswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div id="modalFormUbahSiswa" style="padding: 24px;"></div>
      </div>
   </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
var lastIdKelas = null, lastKelas = null;

function onDateChange() {
   if (lastIdKelas != null) getSiswa(lastIdKelas, lastKelas);
}

function getSiswa(idKelas, kelas) {
   var tanggal = document.getElementById('tanggal').value;
   updatePill(idKelas);

   document.getElementById('dataSiswa').innerHTML = `
      <div class="card" style="text-align:center;padding:48px 24px;">
         <div class="spinner-border text-primary mb-3" role="status" style="color:var(--primary)!important;"></div>
         <div style="font-size:13px;font-weight:500;color:var(--text-muted);">Memuat data kelas <strong style="color:var(--text-primary);">${kelas}</strong>...</div>
      </div>`;

   jQuery.ajax({
      url: "<?= base_url('/admin/absen-siswa'); ?>",
      type: 'post',
      data: { kelas, id_kelas: idKelas, tanggal },
      success: function(response) {
         document.getElementById('dataSiswa').innerHTML = response;
         jQuery('html,body').animate({ scrollTop: jQuery('#dataSiswa').offset().top - 80 }, 400);
      },
      error: function(xhr, status, thrown) {
         document.getElementById('dataSiswa').innerHTML =
            `<div class="card" style="text-align:center;padding:48px;color:var(--danger);">
               <i class="material-icons" style="font-size:40px;display:block;margin-bottom:12px;">error_outline</i>
               Gagal memuat data. Coba lagi.
             </div>`;
      }
   });

   lastIdKelas = idKelas;
   lastKelas   = kelas;
}

function updatePill(activeId) {
   document.querySelectorAll('.kelas-pill').forEach(function(btn) {
      btn.classList.remove('active');
   });
   var el = document.getElementById('kelas-' + activeId);
   if (el) el.classList.add('active');
}

function getDataKehadiran(idPresensi, idSiswa) {
   jQuery.ajax({
      url: "<?= base_url('/admin/absen-siswa/kehadiran'); ?>",
      type: 'post',
      data: { id_presensi: idPresensi, id_siswa: idSiswa },
      success: function(response) { jQuery('#modalFormUbahSiswa').html(response); },
      error: function(xhr, status, thrown) { jQuery('#modalFormUbahSiswa').html(thrown); }
   });
}

function ubahKehadiran() {
   var tanggal = document.getElementById('tanggal').value;
   var form = jQuery('#formUbah').serializeArray();
   form.push({ name: 'tanggal', value: tanggal });

   jQuery.ajax({
      url: "<?= base_url('/admin/absen-siswa/edit'); ?>",
      type: 'post',
      data: form,
      success: function(response) {
         if (response['status']) {
            getSiswa(lastIdKelas, lastKelas);
            jQuery('#ubahModal').modal('hide');
         } else {
            alert('Gagal ubah kehadiran: ' + response['nama_siswa']);
         }
      },
      error: function(xhr, status, thrown) { alert('Gagal ubah kehadiran\n' + thrown); }
   });
}
</script>
<?= $this->endSection() ?>