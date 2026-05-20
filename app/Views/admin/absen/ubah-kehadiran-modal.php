<div class="modal-body" style="padding: 24px;">
   <form id="formUbah">
      <input type="hidden" name="id_siswa" value="<?= $data['id_siswa'] ?? ''; ?>">
      <input type="hidden" name="id_guru" value="<?= $data['id_guru'] ?? ''; ?>">
      <input type="hidden" name="id_kelas" value="<?= $data['id_kelas'] ?? ''; ?>">

      <div style="margin-bottom: 20px;">
         <label style="font-size: 13px; font-weight: 600; color: var(--text-secondary); margin-bottom: 12px; display: block;">Status Kehadiran</label>
         <div style="display: flex; flex-direction: column; gap: 10px;" id="kehadiran">
            <?php foreach ($listKehadiran as $value2) : ?>
               <?php 
                  $idKeh = $value2['id_kehadiran'];
                  $isChecked = $idKeh == ($presensi['id_kehadiran'] ?? '4'); 
                  
                  $colorClass = 'muted'; $colorHex = '#6B7280'; $bgHex = '#F3F4F6';
                  if($idKeh == 1) { $colorClass = 'success'; $colorHex = '#065F46'; $bgHex = '#D1FAE5'; }
                  if($idKeh == 2) { $colorClass = 'warning'; $colorHex = '#92400E'; $bgHex = '#FEF3C7'; }
                  if($idKeh == 3) { $colorClass = 'info'; $colorHex = '#1E40AF'; $bgHex = '#DBEAFE'; }
                  if($idKeh == 4) { $colorClass = 'danger'; $colorHex = '#991B1B'; $bgHex = '#FEE2E2'; }
               ?>
               <label style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border: 1px solid <?= $isChecked ? $colorHex : 'var(--border)' ?>; border-radius: var(--r-md); background: <?= $isChecked ? $bgHex : 'var(--surface)' ?>; cursor: pointer; transition: all 0.2s; margin: 0;">
                  <input type="radio" name="id_kehadiran" value="<?= $idKeh; ?>" <?= $isChecked ? 'checked' : ''; ?> style="width: 16px; height: 16px; accent-color: <?= $colorHex ?>; cursor: pointer;">
                  <span style="font-size: 14px; font-weight: <?= $isChecked ? '600' : '500' ?>; color: <?= $isChecked ? $colorHex : 'var(--text-primary)' ?>;">
                     <?= $value2['kehadiran']; ?>
                  </span>
               </label>
            <?php endforeach; ?>
         </div>
      </div>

      <div style="display: flex; gap: 16px; margin-bottom: 20px;">
         <div style="flex: 1;">
            <label for="jamMasuk" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;">Jam Masuk</label>
            <input class="form-control" type="time" name="jam_masuk" id="jamMasuk" value="<?= $presensi['jam_masuk'] ?? ''; ?>">
         </div>
         <div style="flex: 1;">
            <label for="jamKeluar" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;">Jam Keluar</label>
            <input class="form-control" type="time" name="jam_keluar" id="jamKeluar" value="<?= $presensi['jam_keluar'] ?? ''; ?>">
         </div>
      </div>

      <div>
         <label for="keterangan" style="font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; display: block;">Keterangan / Catatan</label>
         <textarea id="keterangan" name="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan (opsional)"><?= trim($presensi['keterangan'] ?? ''); ?></textarea>
      </div>
   </form>
</div>
<div class="modal-footer" style="border-top: 1px solid var(--border); padding: 16px 24px;">
   <button type="button" class="btn btn-ghost" data-dismiss="modal">Batalkan</button>
   <button type="button" onclick="ubahKehadiran()" class="btn btn-primary" data-dismiss="modal">
      <i class="material-icons" style="font-size: 16px;">save</i> Simpan Perubahan
   </button>
</div>

<script>
// Make the labels update their styles when a radio is selected
document.querySelectorAll('input[name="id_kehadiran"]').forEach(radio => {
   radio.addEventListener('change', function() {
      // Reset all labels
      document.querySelectorAll('#kehadiran label').forEach(label => {
         label.style.border = '1px solid var(--border)';
         label.style.background = 'var(--surface)';
         label.querySelector('span').style.fontWeight = '500';
         label.querySelector('span').style.color = 'var(--text-primary)';
      });
      // Set active label
      if (this.checked) {
         let parent = this.closest('label');
         let colorHex = this.style.accentColor;
         let bgHex = '#F3F4F6';
         if (this.value == 1) bgHex = '#D1FAE5';
         if (this.value == 2) bgHex = '#FEF3C7';
         if (this.value == 3) bgHex = '#DBEAFE';
         if (this.value == 4) bgHex = '#FEE2E2';
         
         parent.style.border = '1px solid ' + colorHex;
         parent.style.background = bgHex;
         parent.querySelector('span').style.fontWeight = '600';
         parent.querySelector('span').style.color = colorHex;
      }
   });
});
</script>