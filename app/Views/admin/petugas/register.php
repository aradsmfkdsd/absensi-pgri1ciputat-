<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<!-- PAGE HEADER -->
<div class="admin-page-header">
   <div>
      <h1 class="page-title">Registrasi Petugas</h1>
      <div class="breadcrumb">
         <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
         <span class="breadcrumb-sep">›</span>
         <a href="<?= base_url('admin/petugas'); ?>">Data Petugas</a>
         <span class="breadcrumb-sep">›</span>
         <span class="breadcrumb-active">Tambah Petugas</span>
      </div>
   </div>
   <div class="page-header-actions">
      <a href="<?= base_url('admin/petugas'); ?>" class="btn btn-outline">
         <i class="material-icons">arrow_back</i> Kembali
      </a>
   </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto;">
   <div style="margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--border);">
      <h2 style="font-size:16px;font-weight:600;color:var(--text-primary);">Buat Akun Petugas Baru</h2>
      <p style="font-size:13px;color:var(--text-muted);">Masukkan informasi untuk mendaftarkan petugas absensi atau admin.</p>
   </div>

   <?= view('Myth\Auth\Views\_message_block') ?>

   <form action="<?= base_url('admin/petugas/register') ?>" method="post">
      <?= csrf_field() ?>

      <div style="display: flex; gap: 24px; flex-wrap: wrap; margin-bottom: 20px;">
         <div style="flex: 1; min-width: 250px;">
            <label for="username" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;"><?= lang('Auth.username') ?></label>
            <input type="text" id="username" class="form-control <?php if (session('errors.username')): ?>is-invalid<?php endif ?>" name="username" placeholder="Masukkan username" value="<?= old('username') ?>">
            <?php if (session('errors.username')): ?>
               <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
                  <?= session('errors.username') ?>
               </div>
            <?php endif; ?>
         </div>

         <div style="flex: 1; min-width: 250px;">
            <label for="email" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;"><?= lang('Auth.email') ?></label>
            <input type="email" id="email" class="form-control <?php if (session('errors.email')): ?>is-invalid<?php endif ?>" name="email" placeholder="contoh@sekolah.id" value="<?= old('email') ?>">
            <?php if (session('errors.email')): ?>
               <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
                  <?= session('errors.email') ?>
               </div>
            <?php endif; ?>
         </div>
      </div>

      <div style="display: flex; gap: 24px; flex-wrap: wrap; margin-bottom: 20px;">
         <div style="flex: 1; min-width: 250px;">
            <label for="password" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;"><?= lang('Auth.password') ?></label>
            <input type="password" id="password" name="password" class="form-control <?php if (session('errors.password')): ?>is-invalid<?php endif ?>" placeholder="Masukkan password" autocomplete="off">
            <?php if (session('errors.password')): ?>
               <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
                  <?= session('errors.password') ?>
               </div>
            <?php endif; ?>
         </div>

         <div style="flex: 1; min-width: 250px;">
            <label for="pass_confirm" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;"><?= lang('Auth.repeatPassword') ?></label>
            <input type="password" id="pass_confirm" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')): ?>is-invalid<?php endif ?>" placeholder="Ulangi password" autocomplete="off">
            <?php if (session('errors.pass_confirm')): ?>
               <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
                  <?= session('errors.pass_confirm') ?>
               </div>
            <?php endif; ?>
         </div>
      </div>

      <div style="display: flex; gap: 24px; flex-wrap: wrap; margin-bottom: 32px;">
         <div style="flex: 1; min-width: 250px;">
            <label for="role" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;">Role Akun</label>
            <select class="form-control form-select <?php if (session('errors.role')): ?>is-invalid<?php endif ?>" id="role" name="role">
               <option value="">-- Pilih Role --</option>
               <?php foreach ($roles as $role): ?>
                  <option value="<?= $role->value ?>" <?= old('role') == (string) $role->value ? 'selected' : ''; ?>>
                     <?= $role->label() ?>
                  </option>
               <?php endforeach; ?>
            </select>
            <?php if (session('errors.role')): ?>
               <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
                  <?= session('errors.role') ?>
               </div>
            <?php endif; ?>
         </div>

         <div style="flex: 1; min-width: 250px;">
            <label for="id_guru" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;">Hubungkan ke Guru <span style="font-weight: normal; color: var(--text-muted);">(Opsional)</span></label>
            <select class="form-control form-select" id="id_guru" name="id_guru">
               <option value="">-- Tidak Dihubungkan --</option>
               <?php foreach ($guru as $g): ?>
                  <option value="<?= $g['id_guru']; ?>" <?= old('id_guru') == $g['id_guru'] ? 'selected' : ''; ?>><?= $g['nama_guru']; ?></option>
               <?php endforeach; ?>
            </select>
         </div>
      </div>

      <div style="padding-top: 20px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 12px;">
         <button type="submit" class="btn btn-primary">
            <i class="material-icons">person_add</i> <?= lang('Auth.register') ?>
         </button>
      </div>
   </form>
</div>

<?= $this->endSection() ?>