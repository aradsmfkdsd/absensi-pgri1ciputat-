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
         <a class="btn btn-primary" href="<?= base_url('admin/siswa/create'); ?>">
            <i class="material-icons">add</i> Tambah Siswa
         </a>
         <a class="btn btn-outline bg-white hover:bg-gray-50 border-gray-200" href="<?= base_url('admin/siswa/bulk'); ?>">
            <i class="material-icons text-primary">upload_file</i> Import CSV
         </a>
         <button class="btn btn-outline bg-white hover:bg-red-50 border-red-200 text-red-600 hover:text-red-700 btn-table-delete ml-auto" onclick="deleteSelectedSiswa('Data yang sudah dihapus tidak bisa dikembalikan');">
            <i class="material-icons">delete_sweep</i> Bulk Delete
         </button>
      </div>

      <!-- Main Card -->
      <div class="card mb-0">
         <div class="card-header flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
               <h4 class="card-title font-bold text-gray-900">Daftar Siswa</h4>
               <p class="card-category text-sm text-gray-500 mt-1">Angkatan <?= $generalSettings->school_year; ?></p>
            </div>
         </div>
         
         <div class="card-body">
            <!-- Filters -->
            <div class="bg-gray-50/50 p-4 sm:p-6 rounded-xl border border-gray-100 mb-6">
               <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                  <div>
                     <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tingkat</label>
                     <select name="kelas" id="filterKelasSiswa" class="form-select bg-white">
                        <option value="">-- Semua Tingkat --</option>
                        <?php foreach ($tingkat as $value): ?>
                           <option value="<?= $value['tingkat']; ?>"><?= $value['tingkat']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <div>
                     <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Indeks Kelas</label>
                     <select name="index" id="filterIndexSiswa" class="form-select bg-white">
                        <option value="">-- Semua Indeks --</option>
                        <?php foreach ($index_kelas as $value): ?>
                           <option value="<?= $value['index_kelas']; ?>"><?= $value['index_kelas']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>
            </div>

            <!-- Data Table Container -->
            <div id="dataSiswa" class="min-h-[300px]">
               <div class="flex justify-center items-center py-16">
                   <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-primary"></div>
                   <span class="ml-3 text-gray-500 font-medium">Memuat data siswa...</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
   var kelas = null;
   var jurusan = null;
   var index = null;

   getDataSiswa(kelas, jurusan, index);

   $('#filterKelasSiswa').on('change', function () {
      kelas = $(this).val() || null;
      trig();
   });


   $('#filterIndexSiswa').on('change', function () {
      index = $(this).val() || null;
      trig();
   });

   function trig() {
      $('#dataSiswa').html('<div class="flex justify-center items-center py-16"><div class="animate-spin rounded-full h-10 w-10 border-b-2 border-primary"></div><span class="ml-3 text-gray-500 font-medium">Memuat data siswa...</span></div>');
      getDataSiswa(kelas, jurusan, index);
   }

   function getDataSiswa(_kelas = null, _jurusan = null, _index = null) {
      jQuery.ajax({
         url: "<?= base_url('/admin/siswa'); ?>",
         type: 'post',
         data: {
            'kelas': _kelas,
            'jurusan': _jurusan,
            'index': _index
         },
         success: function (response, status, xhr) {
            $('#dataSiswa').html(response);
         },
         error: function (xhr, status, thrown) {
            console.log(thrown);
            $('#dataSiswa').html('<div class="text-center text-red-500 py-8">Gagal memuat data. Silakan coba lagi.</div>');
         }
      });
   }

   document.addEventListener('DOMContentLoaded', function () {
      // Re-delegate checkAll since dataSiswa content is dynamic
      $(document).on('click', '#checkAll', function (e) {
         $('input:checkbox').not(this).prop('checked', this.checked);
      });
   });
</script>
<?= $this->endSection() ?>