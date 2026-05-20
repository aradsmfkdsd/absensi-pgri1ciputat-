<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
  <div class="container-fluid px-0">
    
    <?= view('admin/_messages'); ?>

    <!-- DAFTAR KELAS -->
    <div class="card mb-0 flex flex-col h-full" style="border-radius: 16px; background: #ffffff; box-shadow: 0 4px 24px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.05); padding: 24px;">
      <div class="card-header border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4" style="padding-bottom: 20px; margin-bottom: 20px;">
        <div>
          <h4 class="card-title font-bold text-gray-900" style="font-size: 20px;">Daftar Kelas</h4>
          <p class="card-category text-sm text-gray-500 mt-1">Angkatan <?= $generalSettings->school_year; ?></p>
        </div>
        <div class="flex flex-wrap gap-2">
          <a class="btn btn-sm btn-primary" href="<?= base_url('admin/kelas/tambah'); ?>" style="height: 38px; border-radius: 8px; display: inline-flex; align-items: center; padding: 0 16px; font-weight: 600;">
            <i class="material-icons text-[16px] mr-1">add</i> Baru
          </a>
          <a class="btn btn-sm btn-outline hover:bg-gray-50 bg-white" href="<?= base_url('admin/kelas/bulk'); ?>" style="height: 38px; border-radius: 8px; display: inline-flex; align-items: center; padding: 0 16px; font-weight: 600; border-color: #cbd5e1; color: #334155;">
            <i class="material-icons text-primary text-[16px] mr-1">upload_file</i> Import
          </a>
          <button class="btn btn-sm btn-outline hover:bg-gray-50 bg-white" onclick="fetchKelasJurusanData('kelas', '#dataKelas')" style="height: 38px; width: 38px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; border-color: #cbd5e1; color: #64748b;">
            <i class="material-icons text-[18px]">refresh</i>
          </button>
        </div>
      </div>
      
      <div class="card-body p-0 flex-1 relative">
        <div id="dataKelas" class="h-full min-h-[300px]">
          <div class="flex justify-center items-center py-16">
              <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
              <span class="ml-3 text-gray-500 font-medium">Memuat data kelas...</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    fetchKelasJurusanData('kelas', '#dataKelas');
  });
</script>
<?= $this->endSection() ?>