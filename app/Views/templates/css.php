<?php
$assetVersion = '2.0.0';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/fonts/fonts.css?v=' . $assetVersion); ?>" />
<link rel="stylesheet" href="<?= base_url('assets/css/material-dashboard.min.css?v=' . $assetVersion); ?>" />

<!-- Tailwind CSS for modern utility classes without breaking Bootstrap -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    corePlugins: {
      preflight: false,
    },
    theme: {
      extend: {
        colors: {
          primary: '#7C3AED',
        }
      }
    }
  }
</script>

<link rel="stylesheet" href="<?= base_url('assets/css/modern-academic-v2.css?v=' . $assetVersion); ?>" />
<link rel="stylesheet" href="<?= base_url('assets/js/plugins/file-uploader/css/jquery.dm-uploader.min.css?v=' . $assetVersion); ?>" />
<link rel="stylesheet" href="<?= base_url('assets/js/plugins/file-uploader/css/styles-1.0.css?v=' . $assetVersion); ?>" />

<?= $this->renderSection("styles") ?>