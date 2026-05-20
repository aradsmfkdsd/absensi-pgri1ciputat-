<?php 
   $total = count($data ?? []);
   if (!function_exists('avatarBg')) {
      function avatarBg(string $name): string {
         $palette = ['7C3AED','10B981','3B82F6','F59E0B','EF4444','06B6D4','F97316','8B5CF6'];
         return $palette[ord(strtolower($name[0] ?? 'a')) % count($palette)];
      }
   }
?>

<div class="card" style="padding: 28px; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.05); background: #ffffff;">
   <!-- Table Header & Search -->
   <div class="flex items-center justify-between" style="margin-bottom: 24px; gap: 16px; flex-wrap: wrap;">
      <div>
         <div style="font-size: 18px; font-weight: 700; color: var(--text-primary); letter-spacing: -0.3px;">Daftar Petugas / Admin</div>
         <div style="font-size: 14px; color: var(--text-muted); margin-top: 4px;">
            Total: <strong style="color: var(--primary); font-weight: 600;"><?= $total; ?></strong> akun terdaftar
         </div>
      </div>
      
      <div class="flex items-center gap-3" style="flex-wrap: wrap;">
         <div style="position: relative; display: flex; align-items: center; min-width: 280px;">
            <i class="material-icons" style="position: absolute; left: 14px; font-size: 20px; color: var(--text-muted); pointer-events: none;">search</i>
            <input type="text" id="searchPetugas" class="form-control" placeholder="Cari username / email…" oninput="filterTable()" style="padding-left: 44px !important; height: 44px; border-radius: 10px; font-size: 14px; border: 1px solid var(--border); width: 100%; box-shadow: none;">
         </div>
      </div>
   </div>

   <?php if (!empty($data)): ?>
   <div class="table-responsive border-0" style="overflow-x: auto; margin: 0 -28px; padding: 0 28px;">
      <table id="tabelPetugas" style="width: 100%; border-collapse: separate; border-spacing: 0;">
         <thead>
            <tr style="background: #f8fafc;">
               <th style="padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b; text-align: left; border-bottom: 2px solid #e2e8f0; border-top-left-radius: 10px; border-bottom-left-radius: 10px; white-space: nowrap;">User</th>
               <th style="padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b; text-align: left; border-bottom: 2px solid #e2e8f0; white-space: nowrap;">Email</th>
               <th style="padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b; text-align: left; border-bottom: 2px solid #e2e8f0; white-space: nowrap;">Role</th>
               <th style="padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b; text-align: left; border-bottom: 2px solid #e2e8f0; white-space: nowrap;">Terkait Guru</th>
               <th style="padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b; text-align: left; border-bottom: 2px solid #e2e8f0; white-space: nowrap;">Status</th>
               <th style="padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b; text-align: right; border-bottom: 2px solid #e2e8f0; border-top-right-radius: 10px; border-bottom-right-radius: 10px; white-space: nowrap;">Aksi</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($data as $value): 
               $initials = strtoupper(substr($value['username'], 0, 2));
               $bg = avatarBg($value['username']);
               $isActive = ($value['active'] ?? 0) == 1;
            ?>
               <tr style="transition: all 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                  <td style="padding: 18px 20px; border-bottom: 1px solid #f1f5f9; white-space: nowrap;">
                     <div class="flex items-center gap-3">
                        <div style="width: 40px !important; height: 40px !important; border-radius: 50% !important; background: #<?= $bg; ?>; color: #ffffff; font-size: 14px; font-weight: 700; display: flex !important; align-items: center !important; justify-content: center !important; flex-shrink: 0; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                           <?= $initials; ?>
                        </div>
                        <div>
                           <div style="font-size: 15px; font-weight: 600; color: #1e293b;"><?= esc($value['username']); ?></div>
                        </div>
                     </div>
                  </td>
                  
                  <td style="padding: 18px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #f1f5f9; white-space: nowrap;"><?= esc($value['email']); ?></td>
                  
                  <td style="padding: 18px 20px; border-bottom: 1px solid #f1f5f9; white-space: nowrap;">
                     <span style="font-size: 13px; font-weight: 600; color: #334155; background: #f1f5f9; padding: 6px 12px; border-radius: 8px; display: inline-block; white-space: nowrap;">
                        <?= getUserRole($value['is_superadmin']); ?>
                     </span>
                  </td>
                  
                  <td style="padding: 18px 20px; color: #64748b; font-size: 14px; border-bottom: 1px solid #f1f5f9; white-space: nowrap;">
                     <?= esc($value['nama_guru'] ?? '—'); ?>
                  </td>
                  
                  <td style="padding: 18px 20px; border-bottom: 1px solid #f1f5f9; white-space: nowrap;">
                     <?php if ($isActive): ?>
                        <span class="badge badge-success" style="padding: 6px 12px; font-size: 12px; font-weight: 600; border-radius: 20px; display: inline-block;">Aktif</span>
                     <?php else: ?>
                        <span class="badge badge-danger" style="padding: 6px 12px; font-size: 12px; font-weight: 600; border-radius: 20px; display: inline-block;">Non-aktif</span>
                     <?php endif; ?>
                  </td>
                  
                  <td style="padding: 18px 20px; text-align: right; border-bottom: 1px solid #f1f5f9;">
                     <?php if ($value['username'] == 'superadmin'): ?>
                        <button disabled class="btn btn-sm btn-outline" style="opacity: 0.5; cursor: not-allowed; padding: 8px 14px; height: 38px; border-radius: 8px;" title="Superadmin tidak dapat diubah">
                           <i class="material-icons" style="font-size: 16px;">lock</i>
                        </button>
                     <?php else: ?>
                        <div class="flex items-center justify-end gap-2">
                           <a href="<?= base_url('admin/petugas/activate/' . $value['id']); ?>"
                              title="<?= $isActive ? 'Non-aktifkan' : 'Aktifkan'; ?>"
                              class="btn btn-sm <?= $isActive ? 'btn-outline' : 'btn-primary'; ?>"
                              style="height: 38px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; padding: 0 14px; <?= $isActive ? 'color: #f59e0b; border-color: rgba(245,158,11,0.3); background: rgba(245,158,11,0.08);' : 'background: #10b981; border-color: #10b981; color: #ffffff;'; ?>">
                              <i class="material-icons" style="font-size: 16px;"><?= $isActive ? 'block' : 'check_circle'; ?></i>
                           </a>
                           
                           <a href="<?= base_url('admin/petugas/edit/' . $value['id']); ?>" 
                              title="Edit Data"
                              class="btn btn-sm btn-outline" 
                              style="height: 38px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; padding: 0 14px; color: #3b82f6; border-color: rgba(59,130,246,0.3); background: rgba(59,130,246,0.08);">
                              <i class="material-icons" style="font-size: 16px;">edit</i>
                           </a>
                           
                           <form action="<?= base_url('admin/petugas/delete/' . $value['id']); ?>" method="post" class="d-inline m-0 p-0">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="_method" value="DELETE">
                              <button onclick="return confirm('Yakin ingin menghapus akun ini?');" type="submit"
                                 title="Hapus Akun"
                                 class="btn btn-sm btn-outline" 
                                 style="height: 38px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; padding: 0 14px; color: #ef4444; border-color: rgba(239,68,68,0.3); background: rgba(239,68,68,0.08);">
                                 <i class="material-icons" style="font-size: 16px;">delete_outline</i>
                              </button>
                           </form>
                        </div>
                     <?php endif; ?>
                  </td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
   
   <!-- Footer: count -->
   <div class="flex items-center justify-between" style="margin-top: 28px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
      <div style="font-size: 14px; color: #64748b;">
         Menampilkan <strong style="color: #0f172a; font-weight: 700;" id="rowCount"><?= $total; ?></strong> data akun terdaftar
      </div>
   </div>
   
   <?php else: ?>
   <!-- Empty State -->
   <div style="text-align:center;padding:48px 24px;">
      <i class="material-icons" style="font-size:48px;color:var(--border);display:block;margin-bottom:12px;">group_off</i>
      <div style="font-size:14px;font-weight:500;color:var(--text-secondary);">Tidak ada data petugas</div>
      <div style="font-size:12px;color:var(--text-muted);margin-top:4px;">Silakan tambah petugas baru atau gunakan bulk import.</div>
   </div>
   <?php endif; ?>
</div>

<script>
function filterTable() {
   var q = document.getElementById('searchPetugas').value.toLowerCase();
   var rows = document.querySelectorAll('#tabelPetugas tbody tr');
   var visible = 0;
   rows.forEach(function(row) {
      var text = row.textContent.toLowerCase();
      var show = text.includes(q);
      row.style.display = show ? '' : 'none';
      if (show) visible++;
   });
   var el = document.getElementById('rowCount');
   if (el) el.textContent = visible;
}
</script>