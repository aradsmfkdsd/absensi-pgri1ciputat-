<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid px-0">
      
      <!-- Date Filter Card -->
      <div class="card mb-6">
         <div class="card-body">
            <div class="flex flex-col sm:flex-row sm:items-end gap-4">
               <div class="w-full sm:w-64">
                  <label class="block text-sm font-medium text-gray-600 mb-2">Tanggal Kehadiran</label>
                  <input class="form-control" type="date" name="tanggal" id="tanggal"
                     value="<?= $date; ?>" onchange="getSiswa(<?= $kelas['id_kelas']; ?>, '<?= $kelas['kelas']; ?>')">
               </div>
            </div>
         </div>
      </div>

      <!-- Data Table Card -->
      <div class="card" id="dataSiswa">
         <div class="card-body">
             <div class="flex justify-center items-center py-16">
                 <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-primary"></div>
                 <span class="ml-3 text-gray-500 font-medium">Memuat data absensi...</span>
             </div>
         </div>
      </div>
   </div>

   <!-- Modal ubah kehadiran -->
   <div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="modalUbahKehadiran" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header flex justify-between items-center">
               <h5 class="modal-title font-semibold text-gray-800" id="modalUbahKehadiran">Ubah Kehadiran Siswa</h5>
               <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors" data-bs-dismiss="modal" aria-label="Close">
                  <i class="material-icons text-2xl">close</i>
               </button>
            </div>
            <div id="modalFormUbahSiswa"></div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var lastIdKelas = <?= $kelas['id_kelas']; ?>;
    var lastKelas = '<?= $kelas['kelas']; ?>';

   $(document).ready(function() {
       getSiswa(lastIdKelas, lastKelas);
   });

   function getSiswa(idKelas, kelas) {
      var tanggal = $('#tanggal').val();

      jQuery.ajax({
         url: "<?= base_url('/teacher/attendance/get-list'); ?>",
         type: 'post',
         data: {
            'kelas': kelas,
            'id_kelas': idKelas,
            'tanggal': tanggal
         },
         success: function (response, status, xhr) {
            $('#dataSiswa').html(response);
         },
         error: function (xhr, status, thrown) {
            console.log(thrown);
            $('#dataSiswa').html('<div class="text-center text-red-500 py-8">Gagal memuat data. Silakan coba lagi.</div>');
         }
      });
      lastIdKelas = idKelas;
      lastKelas = kelas;
   }

   function getDataKehadiran(idPresensi, idSiswa) {
      jQuery.ajax({
         url: "<?= base_url('/teacher/attendance/get-edit-modal'); ?>",
         type: 'post',
         data: {
            'id_presensi': idPresensi,
            'id_siswa': idSiswa
         },
         success: function (response, status, xhr) {
            $('#modalFormUbahSiswa').html(response);
         },
         error: function (xhr, status, thrown) {
            console.log(thrown);
            $('#modalFormUbahSiswa').html('<div class="p-6 text-center text-red-500">Gagal memuat form.</div>');
         }
      });
   }

   function ubahKehadiran() {
      var tanggal = $('#tanggal').val();
      var form = $('#formUbah').serializeArray();

      form.push({
         name: 'tanggal',
         value: tanggal
      });

      jQuery.ajax({
         url: "<?= base_url('/teacher/attendance/update-single'); ?>",
         type: 'post',
         data: form,
         success: function (response, status, xhr) {
            if (response['status']) {
               getSiswa(lastIdKelas, lastKelas);
               $('#ubahModal').modal('hide');
               // Basic toast placeholder, you might want to use a real toast library
               alert('Berhasil ubah kehadiran: ' + response['nama_siswa']);
            } else {
               alert('Gagal ubah kehadiran: ' + response['nama_siswa']);
            }
         },
         error: function (xhr, status, thrown) {
            console.log(thrown);
            alert('Gagal ubah kehadiran\n' + thrown);
         }
      });
   }
</script>
<?= $this->endSection() ?>
