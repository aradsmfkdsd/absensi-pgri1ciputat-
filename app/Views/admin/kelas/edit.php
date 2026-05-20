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
              <h4 class="text-lg font-bold text-gray-900">Edit Data Kelas</h4>
              <p class="text-sm text-gray-500 mt-1">Perbarui informasi kelas pada form di bawah ini.</p>
           </div>
           <a href="<?= base_url('admin/kelas') ?>" class="btn btn-outline hover:bg-gray-50">
              <i class="material-icons text-[18px]">arrow_back</i> Kembali
           </a>
        </div>
        
        <div class="card-body">
          <form action="<?= base_url('admin/kelas/editKelasPost'); ?>" method="post" class="space-y-6">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= esc($kelas->id_kelas); ?>">
            <input type="hidden" name="back_url" value="<?= currentFullURL(); ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tingkat <span class="text-red-500">*</span></label>
                <input type="text" id="tingkat" name="tingkat"
                   class="form-control <?= invalidFeedback('tingkat') ? 'border-red-500 focus:ring-red-500' : ''; ?>"
                   placeholder="Contoh: VII, VIII, IX" value="<?= old('tingkat') ?? $kelas->tingkat ?? '' ?>" required>
                <?php if (invalidFeedback('tingkat')): ?>
                   <p class="mt-1 text-sm text-red-500"><?= invalidFeedback('tingkat'); ?></p>
                <?php endif; ?>
              </div>

              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Index Kelas <span class="text-red-500">*</span></label>
                <input type="text" id="index_kelas" name="index_kelas"
                   class="form-control <?= invalidFeedback('index_kelas') ? 'border-red-500 focus:ring-red-500' : ''; ?>"
                   placeholder="Contoh: A, B, C, 1, 2" value="<?= old('index_kelas') ?? $kelas->index_kelas ?? '' ?>" required>
                <?php if (invalidFeedback('index_kelas')): ?>
                   <p class="mt-1 text-sm text-red-500"><?= invalidFeedback('index_kelas'); ?></p>
                <?php endif; ?>
              </div>

              <input type="hidden" name="id_jurusan" value="1">

              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Wali Kelas</label>
                <select class="form-select <?= invalidFeedback('id_wali_kelas') ? 'border-red-500 focus:ring-red-500' : ''; ?>"
                   id="id_wali_kelas" name="id_wali_kelas">
                  <option value="">-- Pilih Wali Kelas --</option>
                  <?php foreach ($guru as $value): ?>
                    <option value="<?= $value['id_guru']; ?>" <?= $kelas->id_wali_kelas == $value['id_guru'] ? 'selected' : ''; ?>>
                      <?= $value['nama_guru']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php if (invalidFeedback('id_wali_kelas')): ?>
                   <p class="mt-1 text-sm text-red-500"><?= invalidFeedback('id_wali_kelas'); ?></p>
                <?php endif; ?>
              </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
               <button type="submit" class="btn btn-primary">
                  <i class="material-icons">save</i> Update Kelas
               </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>