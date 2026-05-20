<div class="table-responsive border-0 rounded-none">
  <table class="table table-hover">
    <thead class="text-primary">
      <tr>
        <th width="60">No</th>
        <th>Jurusan</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; foreach ($data as $value): ?>
        <tr>
          <td><?= $i; ?></td>
          <td class="font-semibold text-gray-900"><?= $value['jurusan']; ?></td>
          <td>
            <div class="flex items-center justify-center gap-2">
              <a href="<?= base_url('admin/jurusan/edit/' . $value['id']); ?>" 
                 class="btn btn-sm btn-outline hover:bg-primary-soft hover:text-primary hover:border-primary-soft" title="Edit Jurusan">
                <i class="material-icons text-[18px]">edit</i>
              </a>
              <button onclick='deleteItem("admin/jurusan/deleteJurusanPost","<?= $value["id"]; ?>","Konfirmasi untuk menghapus data jurusan ini?");' 
                 class="btn btn-sm btn-outline hover:bg-red-50 hover:text-red-600 hover:border-red-100" title="Hapus Jurusan">
                <i class="material-icons text-[18px]">delete_outline</i>
              </button>
            </div>
          </td>
        </tr>
      <?php $i++; endforeach; ?>
      <?php if(empty($data)): ?>
        <tr>
          <td colspan="3" class="text-center py-8 text-gray-500">Belum ada data jurusan terdaftar.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>