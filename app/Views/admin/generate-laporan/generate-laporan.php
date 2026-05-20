<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<!-- PAGE HEADER (Clean, avoiding MD conflict) -->
<div class="admin-page-header">
   <div>
      <h1 class="page-title">Generate Laporan</h1>
      <div class="breadcrumb">
         <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
         <span class="breadcrumb-sep">›</span>
         <span class="breadcrumb-active">Generate Laporan</span>
      </div>
   </div>
</div>

<!-- PREMIUM HERO BANNER -->
<div class="premium-hero-card">
   <div>
      <h2 class="premium-hero-title">Pusat Ekspor & Cetak Laporan</h2>
      <p class="premium-hero-subtitle">Unduh rekapitulasi kehadiran bulanan resmi untuk siswa dan guru ke dalam format PDF siap cetak atau Microsoft Word yang dapat diedit.</p>
   </div>
   <div class="premium-hero-badge">
      <i class="material-icons" style="font-size: 18px; color: #34D399;">file_download</i>
      <span>Format Dokumen Resmi</span>
   </div>
</div>

<?= view('admin/_messages'); ?>

<div class="flex flex-col md:flex-row gap-8" style="margin-top: 12px;">
   <!-- LAPORAN SISWA CARD -->
   <div class="flex-1">
      <div class="premium-filter-card h-full flex flex-col" style="margin: 0; border-top-color: var(--primary) !important;">
         <div class="flex items-center gap-4 mb-6">
            <div style="width: 52px; height: 52px; border-radius: var(--r-md); background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
               <i class="material-icons" style="font-size: 28px;">school</i>
            </div>
            <div>
               <h2 style="font-size: 18px; font-weight: 700; color: var(--text-primary); margin: 0;">Laporan Absen Siswa</h2>
               <p style="font-size: 13px; color: var(--text-muted); margin: 2px 0 0 0;">Cetak rekap kehadiran harian per kelas</p>
            </div>
         </div>

         <form action="<?= base_url('admin/laporan/siswa'); ?>" method="post" style="display: flex; flex-direction: column; flex: 1;">
            <div style="margin-bottom: 20px;">
               <label for="tanggalSiswa" style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; display: block;">Bulan / Tahun Laporan</label>
               <input type="month" name="tanggalSiswa" id="tanggalSiswa" class="form-control" value="<?= date('Y-m'); ?>" style="font-weight: 600;">
            </div>

            <div style="margin-bottom: 32px;">
               <label for="kelas" style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; display: block;">Pilih Kelas</label>
               <select name="kelas" id="kelas" class="form-control form-select" style="font-weight: 500;">
                  <option value="">-- Pilih Kelas untuk Dicetak --</option>
                  <?php foreach ($kelas as $key => $value): ?>
                     <?php
                     $idKelas = $value['id_kelas'];
                     $namaKelas = $value['kelas'];
                     $totalSiswa = count($siswaPerKelas[$key]);
                     ?>
                     <option value="<?= $idKelas; ?>">
                        <?= "$namaKelas - ($totalSiswa Siswa)"; ?>
                     </option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div style="margin-top: auto; display: flex; flex-direction: column; gap: 12px;">
               <button type="submit" name="type" value="pdf" class="btn btn-danger w-full justify-center" style="padding: 12px; font-size: 14px; font-weight: 600;">
                  <i class="material-icons" style="font-size: 20px;">picture_as_pdf</i> Unduh Laporan PDF
               </button>
               <button type="submit" name="type" value="doc" class="btn btn-info w-full justify-center" style="padding: 12px; font-size: 14px; font-weight: 600;">
                  <i class="material-icons" style="font-size: 20px;">description</i> Unduh Laporan Word (DOC)
               </button>
            </div>
         </form>
      </div>
   </div>

   <!-- LAPORAN GURU CARD -->
   <div class="flex-1">
      <div class="premium-filter-card h-full flex flex-col" style="margin: 0; border-top-color: var(--primary) !important;">
         <div class="flex items-center gap-4 mb-6">
            <div style="width: 52px; height: 52px; border-radius: var(--r-md); background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm);">
               <i class="material-icons" style="font-size: 28px;">badge</i>
            </div>
            <div>
               <h2 style="font-size: 18px; font-weight: 700; color: var(--text-primary); margin: 0;">Laporan Absen Guru</h2>
               <p style="font-size: 13px; color: var(--text-muted); margin: 2px 0 0 0;">Total guru terdaftar: <strong style="color: var(--primary);"><?= count($guru); ?> Guru</strong></p>
            </div>
         </div>

         <form action="<?= base_url('admin/laporan/guru'); ?>" method="post" style="display: flex; flex-direction: column; flex: 1;">
            <div style="margin-bottom: 32px;">
               <label for="tanggalGuru" style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 8px; display: block;">Bulan / Tahun Laporan</label>
               <input type="month" name="tanggalGuru" id="tanggalGuru" class="form-control" value="<?= date('Y-m'); ?>" style="font-weight: 600;">
            </div>

            <div style="margin-top: auto; display: flex; flex-direction: column; gap: 12px;">
               <button type="submit" name="type" value="pdf" class="btn btn-danger w-full justify-center" style="padding: 12px; font-size: 14px; font-weight: 600;">
                  <i class="material-icons" style="font-size: 20px;">picture_as_pdf</i> Unduh Laporan PDF
               </button>
               <button type="submit" name="type" value="doc" class="btn btn-info w-full justify-center" style="padding: 12px; font-size: 14px; font-weight: 600;">
                  <i class="material-icons" style="font-size: 20px;">description</i> Unduh Laporan Word (DOC)
               </button>
            </div>
         </form>
      </div>
   </div>
</div>

<?= $this->endSection() ?>