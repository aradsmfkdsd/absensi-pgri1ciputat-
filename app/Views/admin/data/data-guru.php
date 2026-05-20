<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid px-0">
      
      <!-- Flash Messages -->
      <?php if (session()->getFlashdata('msg')): ?>
         <div class="mb-6">
            <div class="p-4 rounded-lg flex items-center justify-between <?= session()->getFlashdata('error') == true ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-green-50 text-green-700 border border-green-200' ?>">
               <div class="flex items-center gap-3">
                  <i class="material-icons"><?= session()->getFlashdata('error') == true ? 'error_outline' : 'check_circle' ?></i>
                  <span class="font-medium"><?= session()->getFlashdata('msg') ?></span>
               </div>
               <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors" onclick="this.parentElement.style.display='none'">
                  <i class="material-icons">close</i>
               </button>
            </div>
         </div>
      <?php endif; ?>

      <!-- Action Buttons -->
      <div class="flex flex-wrap gap-4 mb-6">
         <a class="btn btn-primary" href="<?= base_url('admin/guru/create'); ?>">
            <i class="material-icons">add</i> Tambah Guru
         </a>
         <a class="btn btn-outline bg-white hover:bg-gray-50 border-gray-200" href="<?= base_url('admin/guru/bulk'); ?>">
            <i class="material-icons text-primary">cloud_upload</i> Import CSV
         </a>
         <button class="btn btn-outline bg-white hover:bg-gray-50 border-gray-200 ml-auto" onclick="trigRefresh();">
            <i class="material-icons text-gray-500">refresh</i> Refresh Data
         </button>
      </div>

      <!-- Main Card -->
      <div class="card mb-0">
         <div class="card-header flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
               <h4 class="card-title font-bold text-gray-900">Daftar Guru</h4>
               <p class="card-category text-sm text-gray-500 mt-1">Angkatan <?= esc($generalSettings->school_year); ?></p>
            </div>
         </div>
         
         <div class="card-body">
            <!-- Data Table Container -->
            <div id="dataGuru" class="min-h-[300px]">
               <div class="flex justify-center items-center py-16">
                   <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-primary"></div>
                   <span class="ml-3 text-gray-500 font-medium">Memuat data guru...</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
   $(document).ready(function() {
      getDataGuru();
   });

   function trigRefresh() {
      $('#dataGuru').html('<div class="flex justify-center items-center py-16"><div class="animate-spin rounded-full h-10 w-10 border-b-2 border-primary"></div><span class="ml-3 text-gray-500 font-medium">Memuat data guru...</span></div>');
      getDataGuru();
   }

   function getDataGuru() {
      jQuery.ajax({
         url: "<?= base_url('/admin/guru'); ?>",
         type: 'post',
         data: {},
         success: function (response, status, xhr) {
            $('#dataGuru').html(response);
         },
         error: function (xhr, status, thrown) {
            console.log(thrown);
            $('#dataGuru').html('<div class="text-center text-red-500 py-8">Gagal memuat data. Silakan coba lagi.</div>');
         }
      });
   }
</script>
<?= $this->endSection() ?>