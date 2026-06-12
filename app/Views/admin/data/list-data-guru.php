<div class="table-responsive">
   <?php if (!$empty) : ?>
      <table class="table table-hover">
         <thead class="text-primary">
            <tr>
               <th width="60">No</th>
               <th>NUPTK</th>
               <th>Nama Guru</th>
               <th>Jenis Kelamin</th>
               <th>No HP</th>
               <th>Alamat</th>
               <th class="text-center">Aksi</th>
            </tr>
         </thead>
         <tbody>
            <?php $i = 1; foreach ($data as $value) : ?>
               <tr>
                  <td><?= $i; ?></td>
                  <td class="font-medium text-gray-700"><?= esc($value['nuptk']); ?></td>
                  <td>
                     <div class="font-semibold text-gray-900"><?= esc($value['nama_guru']); ?></div>
                  </td>
                  <td><?= esc($value['jenis_kelamin']); ?></td>
                  <td><?= esc($value['no_hp']); ?></td>
                  <td class="max-w-[200px] truncate" title="<?= htmlspecialchars($value['alamat']) ?>"><?= esc($value['alamat']); ?></td>
                  <td>
                     <div class="flex items-center justify-center gap-2">
                        <a title="Edit" href="<?= base_url('admin/guru/edit/' . $value['id_guru']); ?>" 
                           class="btn btn-sm btn-outline hover:bg-primary-soft hover:text-primary hover:border-primary-soft">
                           <i class="material-icons text-[18px]">edit</i>
                        </a>
                        <form action="<?= base_url('admin/guru/delete/' . $value['id_guru']); ?>" method="post" class="m-0">
                           <?= csrf_field(); ?>
                           <input type="hidden" name="_method" value="DELETE">
                           <button title="Hapus" type="submit" data-confirm="Konfirmasi untuk menghapus data guru ini?"
                              class="btn btn-sm btn-outline btn-delete-confirm hover:bg-red-50 hover:text-red-600 hover:border-red-100">
                              <i class="material-icons text-[18px]">delete_outline</i>
                           </button>
                        </form>
                        <a title="Download QR Code" href="<?= base_url('admin/qr/guru/' . $value['id_guru'] . '/download'); ?>" 
                           class="btn btn-sm btn-outline hover:bg-blue-50 hover:text-blue-600 hover:border-blue-100">
                           <i class="material-icons text-[18px]">qr_code_2</i>
                        </a>
                     </div>
                  </td>
               </tr>
            <?php $i++; endforeach; ?>
         </tbody>
      </table>
   <?php else : ?>
      <div class="flex flex-col items-center justify-center py-12">
         <i class="material-icons text-6xl text-gray-300 mb-4">search_off</i>
         <h4 class="text-lg font-semibold text-gray-600">Data guru tidak ditemukan</h4>
         <p class="text-sm text-gray-400 mt-1">Belum ada data guru yang terdaftar dalam sistem.</p>
      </div>
   <?php endif; ?>
</div>