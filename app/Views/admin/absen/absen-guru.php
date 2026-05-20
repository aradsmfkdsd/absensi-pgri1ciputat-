<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<!-- PAGE HEADER (Clean, avoiding MD conflict) -->
<div class="admin-page-header">
   <div>
      <h1 class="page-title">Absensi Guru</h1>
      <div class="breadcrumb">
         <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
         <span class="breadcrumb-sep">›</span>
         <span class="breadcrumb-active">Absensi Guru</span>
      </div>
   </div>
</div>

<!-- PREMIUM HERO BANNER -->
<div class="premium-hero-card">
   <div>
      <h2 class="premium-hero-title">Rekap Absensi Guru</h2>
      <p class="premium-hero-subtitle">Pantau presensi tenaga pendidik, rekap jam kerja, dan status kehadiran harian secara real-time.</p>
   </div>
   <div class="premium-hero-badge">
      <i class="material-icons" style="font-size: 18px; color: #34D399;">verified</i>
      <span>Sistem Aktif & Terhubung</span>
   </div>
</div>

<!-- FILTER CARD: Tanggal -->
<div class="premium-filter-card">
   <div class="flex items-center justify-between" style="flex-wrap: wrap; gap: 16px;">
      <div class="flex items-center gap-3">
         <div style="width: 44px; height: 44px; border-radius: var(--r-md); background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center;">
            <i class="material-icons" style="font-size: 24px;">co_present</i>
         </div>
         <div>
            <div style="font-size: 16px; font-weight: 700; color: var(--text-primary);">Pilih Tanggal Absensi</div>
            <div style="font-size: 13px; color: var(--text-muted); margin-top: 2px;">Sistem akan memuat rekap kehadiran guru pada tanggal yang dipilih</div>
         </div>
      </div>
      <!-- Date Picker -->
      <div class="date-picker-btn">
         <i class="material-icons" style="font-size: 18px; color: var(--primary);">calendar_today</i>
         <input type="date" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>" onchange="getGuru()">
      </div>
   </div>
</div>

<!-- DATA TABLE SECTION (loaded via AJAX) -->
<div id="dataGuru">
   <!-- Loading State (Initial) -->
   <div class="card" style="text-align: center; padding: 64px 24px; border: 2px dashed #E5E7EB; box-shadow: none;">
      <div style="width: 64px; height: 64px; background: var(--primary-soft); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto;">
         <i class="material-icons" style="font-size: 32px;">hourglass_empty</i>
      </div>
      <div style="font-size: 16px; font-weight: 700; color: var(--text-primary);">Memuat Rekap Absensi Guru...</div>
      <div style="font-size: 13px; color: var(--text-muted); margin-top: 6px;">Sedang mengambil data kehadiran dari server.</div>
   </div>
</div>

<!-- MODAL Ubah Kehadiran -->
<div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Ubah Kehadiran Guru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div id="modalFormUbahGuru" style="padding: 24px;"></div>
      </div>
   </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
   getGuru();

   function getGuru() {
      var tanggal = $('#tanggal').val();

      document.getElementById('dataGuru').innerHTML = `
         <div class="card" style="text-align:center;padding:48px 24px;">
            <div class="spinner-border text-primary mb-3" role="status" style="color:var(--primary)!important;"></div>
            <div style="font-size:13px;font-weight:500;color:var(--text-muted);">Memuat data absensi guru...</div>
         </div>`;

      jQuery.ajax({
         url: "<?= base_url('/admin/absen-guru'); ?>",
         type: 'post',
         data: {
            'tanggal': tanggal
         },
         success: function(response, status, xhr) {
            $('#dataGuru').html(response);
         },
         error: function(xhr, status, thrown) {
            document.getElementById('dataGuru').innerHTML =
               `<div class="card" style="text-align:center;padding:48px;color:var(--danger);">
                  <i class="material-icons" style="font-size:40px;display:block;margin-bottom:12px;">error_outline</i>
                  Gagal memuat data. Coba lagi.
                </div>`;
         }
      });
   }

   function ubahKehadiran() {
      var tanggal = $('#tanggal').val();
      var form = $('#formUbah').serializeArray();

      form.push({
         name: 'tanggal',
         value: tanggal
      });

      jQuery.ajax({
         url: "<?= base_url('/admin/absen-guru/edit'); ?>",
         type: 'post',
         data: form,
         success: function(response, status, xhr) {
            if (response['status']) {
               // Success silent or small notification
               jQuery('#ubahModal').modal('hide');
            } else {
               alert('Gagal ubah kehadiran : ' + response['nama_guru']);
            }
            getGuru();
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            alert('Gagal ubah kehadiran\n' + thrown);
         }
      });
   }

   function getDataKehadiran(idPresensi, idGuru) {
      jQuery.ajax({
         url: "<?= base_url('/admin/absen-guru/kehadiran'); ?>",
         type: 'post',
         data: {
            'id_presensi': idPresensi,
            'id_guru': idGuru
         },
         success: function(response, status, xhr) {
            $('#modalFormUbahGuru').html(response);
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            $('#modalFormUbahGuru').html(thrown);
         }
      });
   }
</script>
<?= $this->endSection() ?>
