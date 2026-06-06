<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<!-- PAGE HEADER -->
<div class="admin-page-header">
   <div>
      <h1 class="page-title">Edit Data Petugas</h1>
      <div class="breadcrumb">
         <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
         <span class="breadcrumb-sep">›</span>
         <a href="<?= base_url('admin/petugas'); ?>">Data Petugas</a>
         <span class="breadcrumb-sep">›</span>
         <span class="breadcrumb-active">Edit Petugas</span>
      </div>
   </div>
   <div class="page-header-actions">
      <a href="<?= base_url('admin/petugas'); ?>" class="btn btn-outline">
         <i class="material-icons">arrow_back</i> Kembali
      </a>
   </div>
</div>

<?= view('admin/_messages'); ?>

<?php $validation = \Config\Services::validation(); ?>

<div class="card" style="max-width: 800px; margin: 0 auto;">
   <div style="margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--border);">
      <h2 style="font-size:16px;font-weight:600;color:var(--text-primary);">Form Edit Akun Petugas</h2>
      <p style="font-size:13px;color:var(--text-muted);">Ubah informasi akun dan atur role petugas absensi.</p>
   </div>

   <form action="<?= base_url('admin/petugas/edit'); ?>" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= $data['id']; ?>">

      <div style="margin-bottom: 20px;">
         <label for="username" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;">Username</label>
         <input type="text" id="username" class="form-control <?= $validation->getError('username') ? 'is-invalid' : ''; ?>" name="username" placeholder="Masukkan username" value="<?= old('username') ?? $oldInput['username'] ?? $data['username'] ?>">
         <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
            <?= $validation->getError('username'); ?>
         </div>
      </div>

      <div style="margin-bottom: 20px;">
         <label for="email" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;">Email</label>
         <input type="email" id="email" class="form-control <?= $validation->getError('email') ? 'is-invalid' : ''; ?>" name="email" placeholder="contoh@sekolah.id" value="<?= old('email') ?? $oldInput['email'] ?? $data['email'] ?>">
         <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
            <?= $validation->getError('email'); ?>
         </div>
      </div>

      <div style="margin-bottom: 20px;">
         <label for="password" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;">Password Baru <span style="font-weight: normal; color: var(--text-muted);">(Opsional, isi jika ingin mengubah)</span></label>
         <input type="password" id="password" class="form-control <?= $validation->getError('password') ? 'is-invalid' : ''; ?>" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah password">
         <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
            <?= $validation->getError('password'); ?>
         </div>
      </div>

      <div style="display: flex; gap: 24px; flex-wrap: wrap; margin-bottom: 24px;">
         <div style="flex: 1; min-width: 250px;">
            <label for="role" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;">Role Akun</label>
            <select class="form-control form-select <?= $validation->getError('role') ? 'is-invalid' : ''; ?>" id="role" name="role">
               <option value="">-- Pilih Role --</option>
               <?php foreach ($roles as $role): ?>
                  <option value="<?= $role->value ?>" <?= (old('role') ?? $oldInput['role'] ?? $data['is_superadmin']) == (string) $role->value ? 'selected' : ''; ?>>
                     <?= $role->label() ?>
                  </option>
               <?php endforeach; ?>
            </select>
            <div class="invalid-feedback" style="font-size: 12px; color: var(--danger); margin-top: 4px;">
               <?= $validation->getError('role'); ?>
            </div>
         </div>

         <div style="flex: 1; min-width: 250px;">
            <label for="id_guru" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;">Hubungkan ke Guru <span style="font-weight: normal; color: var(--text-muted);">(Opsional)</span></label>
            <select class="form-control form-select" id="id_guru" name="id_guru">
               <option value="">-- Tidak Dihubungkan --</option>
               <?php foreach ($guru as $g): ?>
                  <option value="<?= $g['id_guru']; ?>" <?= (old('id_guru') ?? $data['id_guru']) == $g['id_guru'] ? 'selected' : ''; ?>><?= $g['nama_guru']; ?></option>
               <?php endforeach; ?>
            </select>
         </div>
      </div>

      <div style="padding-top: 20px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 12px;">
         <a href="<?= base_url('admin/petugas'); ?>" class="btn btn-ghost">Batal</a>
         <button type="submit" class="btn btn-primary">
            <i class="material-icons">save</i> Simpan Perubahan
         </button>
      </div>
   </form>
</div>

<?= $this->endSection() ?>