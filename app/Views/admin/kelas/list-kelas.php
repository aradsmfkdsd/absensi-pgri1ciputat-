<div class="table-responsive border-0 rounded-none" style="overflow-x: auto; margin: 0 -24px; padding: 0 24px;">
  <table class="table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
    <thead>
      <tr style="background: #f8fafc;">
        <th style="width: 60px; padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; color: #64748b; border-bottom: 2px solid #e2e8f0; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">No</th>
        <th style="padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; color: #64748b; border-bottom: 2px solid #e2e8f0;">Tingkat</th>
        <th style="padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; color: #64748b; border-bottom: 2px solid #e2e8f0;">Indeks</th>
        <th style="padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; color: #64748b; border-bottom: 2px solid #e2e8f0;">Wali Kelas</th>
        <th style="padding: 16px 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; color: #64748b; border-bottom: 2px solid #e2e8f0; text-align: center; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; foreach ($data as $value): ?>
        <tr style="transition: all 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
          <td style="padding: 18px 20px; font-size: 14px; font-weight: 600; color: #64748b; border-bottom: 1px solid #f1f5f9;"><?= $i; ?></td>
          <td style="padding: 18px 20px; font-size: 15px; font-weight: 700; color: #0f172a; border-bottom: 1px solid #f1f5f9;"><?= $value['tingkat']; ?></td>
          <td style="padding: 18px 20px; font-size: 15px; font-weight: 700; color: var(--primary); border-bottom: 1px solid #f1f5f9;"><?= $value['index_kelas']; ?></td>
          <td style="padding: 18px 20px; font-size: 14px; border-bottom: 1px solid #f1f5f9;"><?= $value['nama_wali_kelas'] ? '<span style="font-weight: 600; color: #334155; background: #f1f5f9; padding: 6px 12px; border-radius: 8px;">'.$value['nama_wali_kelas'].'</span>' : '<span style="color: #94a3b8; font-style: italic;">Belum diset</span>'; ?></td>
          <td style="padding: 18px 20px; border-bottom: 1px solid #f1f5f9;">
            <div class="flex items-center justify-center gap-2">
              <a href="<?= base_url('admin/kelas/edit/' . $value['id_kelas']); ?>" 
                 class="btn btn-sm btn-outline" style="height: 36px; width: 36px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; color: #3b82f6; border-color: rgba(59,130,246,0.3); background: rgba(59,130,246,0.08);" title="Edit Kelas">
                <i class="material-icons text-[16px]">edit</i>
              </a>
              <button onclick='deleteItem("admin/kelas/deleteKelasPost","<?= $value["id_kelas"]; ?>","Konfirmasi untuk menghapus kelas ini?");' 
                 class="btn btn-sm btn-outline" style="height: 36px; width: 36px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; color: #ef4444; border-color: rgba(239,68,68,0.3); background: rgba(239,68,68,0.08);" title="Hapus Kelas">
                <i class="material-icons text-[16px]">delete_outline</i>
              </button>
            </div>
          </td>
        </tr>
      <?php $i++; endforeach; ?>
      <?php if(empty($data)): ?>
        <tr>
          <td colspan="5" class="text-center py-12 text-gray-400 font-medium font-size-14">Belum ada data kelas terdaftar.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>