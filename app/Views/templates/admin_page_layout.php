<!DOCTYPE html>
<html lang="id">

<?= $this->include("templates/head") ?>

<body>

<div class="layout-wrapper">

   <!-- Sidebar -->
   <?= $this->include("templates/sidebar") ?>

   <!-- Main Content -->
   <div class="main-content">

      <!-- Header / Topbar -->
      <?= $this->include("templates/navbar") ?>

      <!-- Page Content -->
      <div class="content-body">
         <?= $this->renderSection("content") ?>
      </div>

      <!-- Footer -->
      <?= $this->include("templates/footer") ?>

   </div><!-- /.main-content -->

</div><!-- /.layout-wrapper -->

<?= $this->include("templates/js") ?>

<script>
   var BaseConfig = {
      baseURL: '<?= base_url() ?>',
      csrfTokenName: '<?= csrf_token() ?>',
      textOk: "Ok",
      textCancel: "Batalkan"
   };
</script>

<?= $this->renderSection("scripts") ?>

</body>
</html>
