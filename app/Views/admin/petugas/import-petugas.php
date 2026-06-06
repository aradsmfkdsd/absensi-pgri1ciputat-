<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>

<!-- PAGE HEADER -->
<div class="admin-page-header">
   <div>
      <h1 class="page-title">Import Data Petugas</h1>
      <div class="breadcrumb">
         <a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
         <span class="breadcrumb-sep">›</span>
         <a href="<?= base_url('admin/petugas'); ?>">Data Petugas</a>
         <span class="breadcrumb-sep">›</span>
         <span class="breadcrumb-active">Import Data</span>
      </div>
   </div>
</div>

<?= view('admin/_messages'); ?>

<div class="card">
   <div class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-gray-100">
      <!-- Left: Upload Section (60%) -->
      <div class="flex-1 p-6 sm:p-8">
         <div class="mb-6">
            <h2 style="font-size:16px;font-weight:600;color:var(--text-primary); margin:0 0 4px 0;">Bulk Upload CSV Petugas</h2>
            <p style="font-size:13px;color:var(--text-muted); margin:0;">Import data petugas/user dari CSV</p>
         </div>

         <div class="form-group mb-0" style="padding-bottom: 0 !important;">
            <div class="dm-uploader-container">
               <div id="drag-and-drop-zone" class="dm-uploader p-6 sm:p-8" style="border: 2px dashed rgba(124, 58, 237, 0.25); border-radius: var(--r-xl); text-align: center; background: rgba(124, 58, 237, 0.01); transition: all 0.3s ease; cursor: pointer;">
                  <p class="dm-upload-icon" style="margin-bottom: 16px;">
                     <i class="material-icons" style="font-size: 56px; color: var(--primary); opacity: 0.85;">cloud_upload</i>
                  </p>
                  <h3 style="font-size: 15px; font-weight: 600; color: var(--text-primary); margin-top:0; margin-bottom: 4px;">Tarik &amp; Letakkan File CSV</h3>
                  <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 20px;">atau klik tombol di bawah untuk memilih file</p>
                  <div class="btn btn-primary" style="position: relative; overflow: hidden; padding: 10px 24px; border-radius: var(--r-md); box-shadow: 0 4px 12px rgba(124, 58, 237, 0.2);">
                     <span>Pilih File Browser</span>
                     <input type="file" title='Click to add Files' style="position: absolute; top: 0; right: 0; margin: 0; padding: 0; font-size: 20px; cursor: pointer; opacity: 0; height: 100%;" />
                  </div>
               </div>
            </div>

            <!-- Upload Progress/Spinner -->
            <div id="csv_upload_spinner" class="csv-upload-spinner" style="display:none; text-align: center; margin-top: 24px;">
               <strong class="text-csv-importing" style="font-size: 14px; color: var(--primary);">Mengimpor Data Petugas...</strong>
               <strong class="text-csv-import-completed" style="font-size: 14px; color: var(--success); display: none;">Selesai!</strong>
               <div class="spinner-bounce" style="margin-top: 10px;">
                  <div class="bounce1"></div>
                  <div class="bounce2"></div>
                  <div class="bounce3"></div>
               </div>
            </div>

            <!-- Upload Results List -->
            <div class="csv-uploaded-files-container" style="margin-top: 24px; max-height: 250px; overflow-y: auto;">
               <ul id="csv_uploaded_files" class="list-group csv-uploaded-files" style="list-style: none; padding: 0; margin: 0;"></ul>
            </div>
         </div>
      </div>

      <!-- Right: Help & Instructions (40%) -->
      <div class="w-full lg:w-[320px] p-6 sm:p-8 bg-gray-50/50">
         <div class="mb-6">
            <h2 style="font-size:16px;font-weight:600;color:var(--text-primary); margin:0 0 4px 0;">Panduan Import</h2>
            <p style="font-size:13px;color:var(--text-muted); margin:0;">Dokumen bantuan untuk file CSV</p>
         </div>

         <form action="<?= base_url('admin/petugas/downloadCSVFilePost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div style="display: flex; flex-direction: column; gap: 12px;">
               <button type="button" class="btn btn-outline w-full justify-center" style="border-color: var(--border); background: var(--surface);" data-toggle="modal" data-target="#modalGuru">
                  <i class="material-icons">list_alt</i> Lihat ID Guru
               </button>
               <button class="btn btn-primary w-full justify-center" name="submit" value="csv_petugas_template" style="background: var(--primary); color: #fff;">
                  <i class="material-icons">file_download</i> Download Template CSV
               </button>
            </div>
         </form>

         <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border-soft); font-size: 12px; color: var(--text-secondary); line-height: 1.6;">
            <strong style="color: var(--text-primary);">Catatan Penting:</strong>
            <ul style="padding-left: 16px; margin-top: 8px; color: var(--text-muted); list-style-type: disc;">
               <li>Gunakan template CSV yang disediakan.</li>
               <li>Pastikan format ID Guru sesuai dengan data sistem jika menambahkan akun guru.</li>
               <li>Jangan gunakan tanda kutip ganda (") di dalam file CSV.</li>
            </ul>
         </div>
      </div>
   </div>
</div>

<!-- Modal Daftar Guru -->
<div class="modal fade" id="modalGuru" tabindex="-1" aria-labelledby="modalGuruTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalGuruTitle">Daftar ID Guru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="padding: 0;">
            <div class="table-wrapper" style="border: none; border-radius: 0;">
               <table>
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Nama Guru</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($guru as $value) : ?>
                        <tr>
                           <td style="font-weight: 600; color: var(--primary);">#<?= $value['id_guru']; ?></td>
                           <td style="font-weight: 500; color: var(--text-primary);"><?= $value['nama_guru']; ?></td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<style>
/* Style override for dm-uploader active state */
#drag-and-drop-zone.active {
    border-color: var(--primary) !important;
    background-color: var(--primary-soft) !important;
}
/* Style for uploaded list items */
#csv_uploaded_files li {
    padding: 10px 14px;
    margin-bottom: 8px;
    border-radius: var(--r-md);
    font-size: 13px;
    font-weight: 500;
}
.list-group-item-success {
    background: var(--success-soft);
    color: #065F46;
    border: 1px solid rgba(16,185,129,0.2);
}
.list-group-item-danger {
    background: var(--danger-soft);
    color: #991B1B;
    border: 1px solid rgba(239,68,68,0.2);
}
</style>

<script>
    $(function() {
        $('#drag-and-drop-zone').dmUploader({
            url: '<?= base_url("admin/petugas/generateCSVObjectPost"); ?>',
            multiple: false,
            extFilter: ["csv"],
            extraData: function(id) {
                return {
                    '<?= csrf_token() ?>': '<?= csrf_hash(); ?>'
                };
            },
            onDragEnter: function() {
                this.addClass('active');
            },
            onDragLeave: function() {
                this.removeClass('active');
            },
            onNewFile: function(id, file) {
                $("#csv_upload_spinner").show();
                $("#csv_upload_spinner .spinner-bounce").show();
                $("#csv_upload_spinner .text-csv-importing").show();
                $("#csv_upload_spinner .text-csv-import-completed").hide();
                $("#csv_uploaded_files").empty();
            },
            onUploadSuccess: function(id, response) {
                var numberOfItems = 0;
                var txtFileName = "";
                try {
                    var obj = JSON.parse(response);
                    if (obj.result == 1) {
                        numberOfItems = obj.numberOfItems;
                        txtFileName = obj.txtFileName;
                        if (numberOfItems > 0) {
                            addCSVItem(numberOfItems, txtFileName, 1);
                        } else {
                            $("#csv_upload_spinner").hide();
                        }
                    } else {
                        $("#csv_upload_spinner").hide();
                    }

                } catch (e) {
                    alert("Invalid CSV file! Make sure there are no double quotes in your content. Double quotes can break the CSV structure.");
                }
            }
        });
    });

    function addCSVItem(numberOfItems, txtFileName, index) {
        if (index <= numberOfItems) {
            var data = {
                'txtFileName': txtFileName,
                'index': index
            };
            $.ajax({
                type: "POST",
                url: '<?= base_url("admin/petugas/importCSVItemPost"); ?>',
                data: setAjaxData(data),
                success: function(response) {
                    var objSub = JSON.parse(response);
                    if (objSub.result == 1) {
                        var $liSuccess = $('<li class="list-group-item list-group-item-success"><i class="material-icons" style="font-size:14px;vertical-align:middle;margin-right:4px;">check_circle</i> </li>');
                        $liSuccess.append(document.createTextNode(objSub.index + '. ' + objSub.petugas.username + ' - ' + objSub.petugas.email));
                        $("#csv_uploaded_files").prepend($liSuccess);
                    } else {
                        var msg = objSub.message ? objSub.message : '(Gagal/Duplicate)';
                        $("#csv_uploaded_files").prepend('<li class="list-group-item list-group-item-danger"><i class="material-icons" style="font-size:14px;vertical-align:middle;margin-right:4px;">error</i> ' + objSub.index + '. ' + msg + '</li>');
                    }
                    if (objSub.index == numberOfItems) {
                        $("#csv_upload_spinner .text-csv-importing").hide();
                        $("#csv_upload_spinner .spinner-bounce").hide();
                        $("#csv_upload_spinner .text-csv-import-completed").css('display', 'block');
                    }
                    index = index + 1;
                    addCSVItem(numberOfItems, txtFileName, index);
                },
                error: function(xhr, status, thrown) {
                    var errorMsg = 'Ada Kesalahan Pada CSV';
                    try {
                        var errorResponse = JSON.parse(xhr.responseText);
                        if (errorResponse.message) {
                            errorMsg += ': ' + errorResponse.message;
                        }
                    } catch (e) {
                        if (xhr.responseText) {
                            errorMsg += '. Status: ' + status;
                        }
                    }
                    swal({
                        text: errorMsg,
                        icon: "warning"
                    }).then(function(willDelete) {
                        if (willDelete) {
                            location.reload();
                        }
                    });
                },
            });
        }
    }
</script>
<?= $this->endSection() ?>
