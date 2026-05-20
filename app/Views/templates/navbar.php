<header class="header">
   <!-- Mobile Toggle -->
   <button class="mobile-toggle" onclick="document.getElementById('mainSidebar').classList.toggle('show'); document.getElementById('sidebarOverlay').classList.toggle('show');" style="margin-right: 12px;">
      <i class="material-icons">menu</i>
   </button>

   <!-- Title -->
   <div class="flex-1">
      <h1 class="header-title"><?= $title ?? ''; ?></h1>
   </div>

   <!-- Actions -->
   <div class="header-actions">

      <!-- Open Scanner Button -->
      <a href="<?= base_url('scan/masuk'); ?>" class="btn btn-primary btn-sm">
         <i class="material-icons" style="font-size:15px;">qr_code_scanner</i>
         Open Scanner
      </a>

      <!-- Divider -->
      <div style="width:1px; height:20px; background:var(--border);"></div>

      <!-- User Info -->
      <div class="flex items-center gap-2" style="padding: 0 4px;">
         <div style="width:32px;height:32px;border-radius:50%;background:var(--primary);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;color:#fff;flex-shrink:0;">
            <?= strtoupper(substr(user()->username, 0, 1)); ?>
         </div>
         <div style="line-height:1.3;">
            <div style="font-size:12px;font-weight:600;color:var(--text-primary);"><?= user()->username; ?></div>
            <div style="font-size:10px;color:var(--text-muted);"><?= user_role()->label(); ?></div>
         </div>
      </div>

      <!-- Logout -->
      <a href="<?= base_url('/logout'); ?>" class="header-icon-btn" title="Logout">
         <i class="material-icons">logout</i>
      </a>
   </div>
</header>