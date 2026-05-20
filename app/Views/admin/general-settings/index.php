<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<!-- PAGE HEADER (Clean, avoiding MD conflict) -->
<div class="admin-page-header">
   <div>
      <h1 class="page-title">Pengaturan Umum</h1>
      <div class="breadcrumb">
         <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
         <span class="breadcrumb-sep">›</span>
         <span class="breadcrumb-active">Pengaturan</span>
      </div>
   </div>
</div>

<!-- PREMIUM HERO BANNER -->
<div class="premium-hero-card">
   <div>
      <h2 class="premium-hero-title">Pengaturan Identitas & Sistem</h2>
      <p class="premium-hero-subtitle">Sesuaikan nama institusi, logo resmi sekolah, tahun ajaran aktif, dan teks hak cipta pada footer seluruh halaman aplikasi.</p>
   </div>
   <div class="premium-hero-badge">
      <i class="material-icons" style="font-size: 18px; color: #34D399;">settings_applications</i>
      <span>System Configuration</span>
   </div>
</div>

<?= view('admin/_messages'); ?>

<div class="premium-filter-card" style="max-width: 850px; margin: 12px auto 32px auto; border-top-color: var(--primary) !important;">
   <div class="flex items-center gap-4 mb-8" style="padding-bottom: 20px; border-bottom: 1px solid var(--border);">
      <div style="width: 56px; height: 56px; border-radius: var(--r-md); background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
         <i class="material-icons" style="font-size: 32px;">apartment</i>
      </div>
      <div>
         <h2 style="font-size: 20px; font-weight: 700; color: var(--text-primary); margin: 0;">Informasi & Profil Sekolah</h2>
         <p style="font-size: 13px; color: var(--text-muted); margin: 2px 0 0 0;">Perubahan pada formulir ini akan memperbarui identitas visual sistem secara seketika.</p>
      </div>
   </div>

   <form action="<?= base_url('admin/general-settings/update'); ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      
      <div style="margin-bottom: 24px;">
         <label for="school_name" style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; display: block;">Nama Lengkap Sekolah</label>
         <input type="text" id="school_name" class="form-control <?= invalidFeedback('school_name') ? 'is-invalid' : ''; ?>" name="school_name" placeholder="Contoh: SMP 1 PGRI" value="<?= esc($generalSettings->school_name); ?>" required style="font-weight: 600; padding: 12px 16px; font-size: 14px;">
         <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
            <?= invalidFeedback('school_name'); ?>
         </div>
      </div>

      <div style="margin-bottom: 24px;">
         <label for="school_year" style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; display: block;">Tahun Ajaran Aktif</label>
         <input type="text" id="school_year" class="form-control <?= invalidFeedback('school_year') ? 'is-invalid' : ''; ?>" name="school_year" placeholder="Contoh: 2024/2025" value="<?= esc($generalSettings->school_year); ?>" required style="font-weight: 600; padding: 12px 16px; font-size: 14px;">
         <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
            <?= invalidFeedback('school_year'); ?>
         </div>
      </div>

      <div style="display: flex; gap: 28px; flex-wrap: wrap; margin-bottom: 36px;">
         <div style="flex: 1; min-width: 260px;">
            <label for="copyright" style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; display: block;">Teks Hak Cipta (Copyright Footer)</label>
            <input type="text" id="copyright" class="form-control <?= invalidFeedback('copyright') ? 'is-invalid' : ''; ?>" name="copyright" placeholder="Contoh: © 2024 All rights reserved" value="<?= esc($generalSettings->copyright); ?>" required style="font-weight: 600; padding: 12px 16px; font-size: 14px;">
            <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
               <?= invalidFeedback('copyright'); ?>
            </div>
         </div>

         <div style="flex: 1; min-width: 260px;">
            <label for="logo" style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; display: block;">Logo Sekolah Resmi</label>
            
            <div style="display: flex; gap: 20px; align-items: flex-start; padding: 16px; background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-lg);">
               <div style="width: 84px; height: 84px; border-radius: var(--r-md); border: 2px dashed #D1D5DB; display: flex; align-items: center; justify-content: center; background: #FFFFFF; overflow: hidden; box-shadow: var(--shadow-sm); padding: 4px;">
                  <img id="logo" src="<?= getLogo(); ?>" alt="logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
               </div>
               
               <div style="flex: 1;">
                  <button type="button" onclick="$('#logo-upload').trigger('click');" class="btn" style="background: var(--surface); border: 1px solid var(--primary); color: var(--primary); font-weight: 600; margin-bottom: 8px; padding: 6px 14px; font-size: 13px; border-radius: var(--r-md);">
                     <i class="material-icons" style="font-size: 16px;">cloud_upload</i> Pilih Logo Baru
                  </button>
                  <input type="file" id="logo-upload" name="logo" accept="image/jpg,image/jpeg,image/png,image/gif,image/svg+xml" style="display:none;" onchange="$('#upload-file-info1').html($(this).val().replace(/.*[\/\\]/, '')); document.getElementById('logo').src = window.URL.createObjectURL(this.files[0])">
                  <div style="font-size: 11px; color: var(--text-muted); line-height: 1.5;">
                     Format: PNG, JPG, JPEG, SVG<br>
                     Maksimal ukuran file: 2MB
                  </div>
                  <div id="upload-file-info1" style="font-size: 12px; margin-top: 6px; font-weight: 600; color: var(--primary);"></div>
               </div>
            </div>
         </div>
      </div>

      <div style="padding-top: 24px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end;">
         <button type="submit" class="btn" style="background: linear-gradient(135deg, var(--primary), #6D28D9); color: #FFFFFF; font-weight: 600; padding: 12px 28px; font-size: 15px; border-radius: var(--r-full); box-shadow: 0 4px 14px rgba(124, 58, 237, 0.3);">
            <i class="material-icons" style="font-size: 20px;">save</i> Simpan Pengaturan Sistem
         </button>
      </div>
   </form>
</div>

<?= $this->endSection() ?>