<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Absensi Sekolah QR Code - Sistem absensi modern berbasis QR Code">
   <meta name="theme-color" content="#8B5CF6">

   <?= $this->include("templates/css") ?>

   <title><?= $title ?? 'Absensi' ?> | SMP PGRI 1 CIPUTAT</title>

   <style>
      body {
         background-color: var(--background);
         background-image: radial-gradient(var(--slate-200) 0.5px, transparent 0.5px);
         background-size: 24px 24px;
      }

      .scanner-layout {
         min-height: 100vh;
         display: flex;
         flex-direction: column;
      }

      .scanner-header {
         height: 64px;
         background: rgba(255, 255, 255, 0.8);
         backdrop-filter: blur(8px);
         border-bottom: 1px solid var(--border-color);
         display: flex;
         align-items: center;
         padding: 0 40px;
         position: sticky;
         top: 0;
         z-index: 100;
      }

      video#previewKamera {
         width: 100%;
         height: 100%;
         object-fit: cover;
         border-radius: var(--radius-md);
      }

      .previewParent {
         position: relative;
         width: 100%;
         background: var(--slate-900);
         border-radius: var(--radius-lg);
         overflow: hidden;
         border: 1px solid var(--border-color);
      }
      
      .scan-overlay {
         position: absolute;
         top: 0; left: 0; right: 0; bottom: 0;
         border: 2px solid rgba(139, 92, 246, 0.3);
         border-radius: var(--radius-lg);
         pointer-events: none;
         z-index: 10;
      }

      .unpreview {
         aspect-ratio: 16/9;
         display: flex;
         align-items: center;
         justify-content: center;
         color: var(--slate-400);
         font-size: 14px;
         background: var(--slate-50);
      }
   </style>
</head>

<body>
   <div class="scanner-layout">
      <header class="scanner-header">
         <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-3">
               <div style="width: 32px; height: 32px; background: var(--primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; color: white;">
                  <i class="material-icons" style="font-size: 18px;">qr_code_2</i>
               </div>
               <div>
                  <h1 style="font-size: 14px; font-weight: var(--weight-semibold); line-height: 1.2;">SMP PGRI 1 CIPUTAT</h1>
                  <p style="font-size: 10px; color: var(--slate-500); text-transform: uppercase; tracking: 0.05em;">Presence System</p>
               </div>
            </div>
            
            <div class="flex items-center gap-3">
               <?= $this->renderSection("navaction") ?>
            </div>
         </div>
      </header>

      <main style="flex: 1; padding: 40px;">
         <?= $this->renderSection("content") ?>
      </main>
   </div>

   <?= $this->include("templates/js") ?>

   <script>
      var BaseConfig = {
         baseURL: '<?= base_url(); ?>',
         csrfTokenName: '<?= csrf_token() ?>',
         textOk: "Ok",
         textCancel: "Batalkan"
      };
   </script>
</body>

</html>