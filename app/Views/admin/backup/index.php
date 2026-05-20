<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<!-- PAGE HEADER (Clean, avoiding MD conflict) -->
<div class="admin-page-header">
   <div>
      <h1 class="page-title">Backup & Restore</h1>
      <div class="breadcrumb">
         <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
         <span class="breadcrumb-sep">›</span>
         <span class="breadcrumb-active">Backup & Restore</span>
      </div>
   </div>
</div>

<!-- PREMIUM HERO BANNER -->
<div class="premium-hero-card">
   <div>
      <h2 class="premium-hero-title">Pencadangan & Pemulihan Sistem</h2>
      <p class="premium-hero-subtitle">Lakukan pencadangan (backup) berkala untuk mengamankan seluruh rekam jejak basis data SQL dan arsip foto QR Code, serta pulihkan (restore) sistem dengan cepat saat diperlukan.</p>
   </div>
   <div class="premium-hero-badge">
      <i class="material-icons" style="font-size: 18px; color: #34D399;">security</i>
      <span>Data Protection & Recovery</span>
   </div>
</div>

<?= view('admin/_messages'); ?>

<div class="flex flex-col md:flex-row gap-8" style="margin-top: 12px;">
   
   <!-- DATABASE BACKUP & RESTORE CARD -->
   <div class="flex-1">
      <div class="premium-filter-card h-full flex flex-col" style="margin: 0; border-top-color: var(--primary) !important;">
         <div class="flex items-center gap-4 mb-6">
            <div style="width: 52px; height: 52px; border-radius: var(--r-md); background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
               <i class="material-icons" style="font-size: 28px;">storage</i>
            </div>
            <div>
               <h2 style="font-size: 18px; font-weight: 700; color: var(--text-primary); margin: 0;">Database Backup & Restore</h2>
               <p style="font-size: 13px; color: var(--text-muted); margin: 2px 0 0 0;">Arsipkan struktur dan isi tabel MySQL (.sql)</p>
            </div>
         </div>

         <!-- Backup Section -->
         <div style="margin-bottom: 28px;">
            <label style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px; display: block;">Unduh Cadangan Basis Data</label>
            <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 16px;">Amankan data rekapitulasi, siswa, dan guru saat ini ke dalam berkas SQL lokal.</p>
            <a href="<?= base_url('admin/backup/db/backup'); ?>" class="btn" style="background: linear-gradient(135deg, var(--primary), #6D28D9); color: #FFFFFF; font-weight: 600; padding: 12px 24px; font-size: 14px; border-radius: var(--r-full); box-shadow: 0 4px 14px rgba(124, 58, 237, 0.3); display: flex; align-items: center; justify-content: center; gap: 8px;">
               <i class="material-icons" style="font-size: 20px;">cloud_download</i> Download Database (.sql)
            </a>
         </div>

         <hr style="border: 0; border-top: 1px dashed #E5E7EB; margin: 0 0 28px 0;">

         <!-- Restore Section -->
         <form action="<?= base_url('admin/backup/db/restore'); ?>" method="post" enctype="multipart/form-data" style="margin-top: auto; display: flex; flex-direction: column; gap: 16px;">
            <div>
               <label style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 4px; display: block;">Pulihkan Basis Data (Restore)</label>
               <div style="font-size: 12px; color: #DC2626; font-weight: 600; display: flex; align-items: center; gap: 6px; background: #FEF2F2; padding: 8px 12px; border-radius: var(--r-md); border: 1px solid #FCA5A5; margin-top: 6px;">
                  <i class="material-icons" style="font-size: 16px;">warning_amber</i> Peringatan: Data yang ada di dalam server saat ini akan tertimpa secara permanen!
               </div>
            </div>
            
            <div style="border: 1px solid var(--border); border-radius: var(--r-md); padding: 8px; background: var(--surface);">
               <input type="file" name="file_backup_db" class="form-control" accept=".sql" required style="border: none; padding: 4px; font-size: 13px; font-weight: 500;">
            </div>
            
            <button type="submit" class="btn" style="background: #FEF2F2; color: #DC2626; border: 1px solid #FCA5A5; font-weight: 600; padding: 12px; font-size: 14px; border-radius: var(--r-full); display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.2s;" onmouseover="this.style.background='#FEE2E2'; this.style.borderColor='#EF4444';" onmouseout="this.style.background='#FEF2F2'; this.style.borderColor='#FCA5A5';" onclick="return confirm('APAKAH ANDA YAKIN INGIN MERESTORE DATABASE?\n\nPerhatian: Seluruh data saat ini akan DITIMPA dan HILANG digantikan oleh berkas cadangan ini!')">
               <i class="material-icons" style="font-size: 20px;">cloud_upload</i> Eksekusi Restore Database
            </button>
         </form>
      </div>
   </div>

   <!-- PHOTOS BACKUP & RESTORE CARD -->
   <div class="flex-1">
      <div class="premium-filter-card h-full flex flex-col" style="margin: 0; border-top-color: var(--primary) !important;">
         <div class="flex items-center gap-4 mb-6">
            <div style="width: 52px; height: 52px; border-radius: var(--r-md); background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
               <i class="material-icons" style="font-size: 28px;">photo_library</i>
            </div>
            <div>
               <h2 style="font-size: 18px; font-weight: 700; color: var(--text-primary); margin: 0;">Photos & QR Backup</h2>
               <p style="font-size: 13px; color: var(--text-muted); margin: 2px 0 0 0;">Arsipkan berkas gambar QR Code dalam format terkompresi (.zip)</p>
            </div>
         </div>

         <!-- Backup Section -->
         <div style="margin-bottom: 28px;">
            <label style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px; display: block;">Unduh Cadangan Arsip Foto QR</label>
            <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 16px;">Unduh sekaligus seluruh berkas foto QR Code siswa dan guru ke dalam satu berkas ZIP.</p>
            <a href="<?= base_url('admin/backup/photos/backup'); ?>" class="btn" style="background: linear-gradient(135deg, var(--primary), #6D28D9); color: #FFFFFF; font-weight: 600; padding: 12px 24px; font-size: 14px; border-radius: var(--r-full); box-shadow: 0 4px 14px rgba(124, 58, 237, 0.3); display: flex; align-items: center; justify-content: center; gap: 8px;">
               <i class="material-icons" style="font-size: 20px;">cloud_download</i> Download Foto (.zip)
            </a>
         </div>

         <hr style="border: 0; border-top: 1px dashed #E5E7EB; margin: 0 0 28px 0;">

         <!-- Restore Section -->
         <form action="<?= base_url('admin/backup/photos/restore'); ?>" method="post" enctype="multipart/form-data" style="margin-top: auto; display: flex; flex-direction: column; gap: 16px;">
            <div>
               <label style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 4px; display: block;">Pulihkan Arsip Foto (Restore)</label>
               <div style="font-size: 12px; color: #D97706; font-weight: 600; display: flex; align-items: center; gap: 6px; background: #FEF3C7; padding: 8px 12px; border-radius: var(--r-md); border: 1px solid #FDE68A; margin-top: 6px;">
                  <i class="material-icons" style="font-size: 16px;">info</i> Peringatan: Berkas foto yang sudah ada akan ditimpa apabila memiliki nama file yang sama.
               </div>
            </div>
            
            <div style="border: 1px solid var(--border); border-radius: var(--r-md); padding: 8px; background: var(--surface);">
               <input type="file" name="file_backup_photos" class="form-control" accept=".zip" required style="border: none; padding: 4px; font-size: 13px; font-weight: 500;">
            </div>
            
            <button type="submit" class="btn" style="background: #FEF3C7; color: #D97706; border: 1px solid #FDE68A; font-weight: 600; padding: 12px; font-size: 14px; border-radius: var(--r-full); display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.2s;" onmouseover="this.style.background='#FDE68A'; this.style.borderColor='#F59E0B';" onmouseout="this.style.background='#FEF3C7'; this.style.borderColor='#FDE68A';" onclick="return confirm('Apakah Anda yakin ingin memulihkan (restore) arsip foto dari berkas ZIP ini?')">
               <i class="material-icons" style="font-size: 20px;">cloud_upload</i> Eksekusi Restore Foto
            </button>
         </form>
      </div>
   </div>

</div>

<?= $this->endSection() ?>