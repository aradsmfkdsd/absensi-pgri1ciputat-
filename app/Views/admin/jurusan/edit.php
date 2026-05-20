<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
  <div class="container-fluid px-0">
    
    <div class="max-w-2xl mx-auto">
      <?= view('admin/_messages'); ?>
      
      <!-- Card -->
      <div class="card mb-0">
        <div class="card-header border-b border-gray-100 flex items-center justify-between">
           <div>
              <h4 class="text-lg font-bold text-gray-900">Edit Data Jurusan</h4>
              <p class="text-sm text-gray-500 mt-1">Perbarui nama jurusan pada form di bawah ini.</p>
           </div>
           <a href="<?= base_url('admin/kelas') ?>" class="btn btn-outline hover:bg-gray-50">
              <i class="material-icons text-[18px]">arrow_back</i> Kembali
           </a>
        </div>
        
        <div class="card-body">
          <form action="<?= base_url('admin/jurusan/editJurusanPost'); ?>" method="post" class="space-y-6">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= esc($jurusan->id); ?>">
            <input type="hidden" name="back_url" value="<?= currentFullURL(); ?>">

            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Jurusan <span class="text-red-500">*</span></label>
              <input type="text" id="jurusan" name="jurusan"
                 class="form-control <?= invalidFeedback('jurusan') ? 'border-red-500 focus:ring-red-500' : ''; ?>"
                 placeholder="Contoh: MIPA, IPS, RPL, TKJ" value="<?= old('jurusan') ?? $jurusan->jurusan ?? '' ?>" required>
              <?php if (invalidFeedback('jurusan')): ?>
                 <p class="mt-1 text-sm text-red-500"><?= invalidFeedback('jurusan'); ?></p>
              <?php endif; ?>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
               <button type="submit" class="btn btn-primary">
                  <i class="material-icons">save</i> Update Jurusan
               </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>