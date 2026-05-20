<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<!-- PAGE HEADER (Clean, avoiding MD conflict) -->
<div class="admin-page-header">
   <div>
      <h1 class="page-title">Data Petugas</h1>
      <div class="breadcrumb">
         <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
         <span class="breadcrumb-sep">›</span>
         <span class="breadcrumb-active">Data Petugas</span>
      </div>
   </div>
   <div class="flex items-center gap-3" style="flex-wrap: wrap;">
      <a href="<?= base_url('admin/petugas/bulk'); ?>" class="btn btn-outline" style="border-color: var(--border); background: var(--surface); color: var(--text-secondary); font-weight: 600; padding: 10px 20px; display: inline-flex; align-items: center; gap: 8px;">
         <i class="material-icons" style="font-size: 18px; color: var(--text-muted);">cloud_upload</i> Bulk Import
      </a>
      <a href="<?= base_url('admin/petugas/register'); ?>" class="btn" style="background: linear-gradient(135deg, var(--primary), #6D28D9); color: #fff; font-weight: 600; padding: 10px 20px; border-radius: var(--r-full); box-shadow: 0 4px 14px rgba(124, 58, 237, 0.3); display: inline-flex; align-items: center; gap: 8px;">
         <i class="material-icons" style="font-size: 18px;">add_circle</i> Tambah Petugas Baru
      </a>
   </div>
</div>

<!-- PREMIUM HERO BANNER -->
<div class="premium-hero-card" style="background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%) !important; box-shadow: 0 10px 25px -5px rgba(139, 92, 246, 0.4) !important;">
   <div>
      <h2 class="premium-hero-title">Manajemen Akun Petugas & Admin</h2>
      <p class="premium-hero-subtitle">Kelola hak akses administrator, staf petugas piket, kepala sekolah, dan mesin scanner presensi secara terpusat dan aman.</p>
   </div>
   <div class="premium-hero-badge" style="background: rgba(255, 255, 255, 0.2); border-color: rgba(255, 255, 255, 0.3);">
      <i class="material-icons" style="font-size: 18px; color: #FFFFFF;">admin_panel_settings</i>
      <span>Access Control Center</span>
   </div>
</div>

<?= view('admin/_messages'); ?>

<div id="dataPetugas">
   <div class="card" style="text-align: center; padding: 64px 24px; border: 2px dashed #E5E7EB; box-shadow: none;">
      <div style="width: 64px; height: 64px; background: var(--primary-soft); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto;">
         <div class="spinner-border text-primary" role="status" style="color: var(--primary) !important;"></div>
      </div>
      <div style="font-size: 16px; font-weight: 700; color: var(--text-primary);">Memuat Data Petugas & Admin...</div>
      <div style="font-size: 13px; color: var(--text-muted); margin-top: 6px;">Sedang mengambil daftar akun dan hak akses dari server.</div>
   </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
   getDataPetugas();

   function getDataPetugas() {
      document.getElementById('dataPetugas').innerHTML = `
         <div class="card" style="text-align:center;padding:48px 24px;">
            <div class="spinner-border text-primary mb-3" role="status" style="color:var(--primary)!important;"></div>
            <div style="font-size:13px;font-weight:500;color:var(--text-muted);">Memuat data petugas...</div>
         </div>`;

      jQuery.ajax({
         url: "<?= base_url('/admin/petugas'); ?>",
         type: 'post',
         data: {},
         success: function(response, status, xhr) {
            $('#dataPetugas').html(response);
         },
         error: function(xhr, status, thrown) {
            document.getElementById('dataPetugas').innerHTML =
               `<div class="card" style="text-align:center;padding:48px;color:var(--danger);">
                  <i class="material-icons" style="font-size:40px;display:block;margin-bottom:12px;">error_outline</i>
                  Gagal memuat data. Coba lagi.
                </div>`;
         }
      });
   }
</script>
<?= $this->endSection() ?>
