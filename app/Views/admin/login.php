<?= $this->extend('templates/starting_page_layout'); ?>

<?= $this->section('content'); ?>
<div class="flex items-center justify-center" style="min-height: calc(100vh - 144px); padding: 40px 20px; display: flex; align-items: center; justify-content: center;">
    <div style="width: 100%; max-width: 400px; margin: 0 auto;">
        
        <!-- Welcome Header -->
        <div class="text-center" style="margin-bottom: 32px;">
            <div style="width: 64px; height: 64px; border-radius: 20px; background: #ffffff; box-shadow: 0 8px 24px rgba(124,58,237,0.12); border: 1px solid rgba(124,58,237,0.1); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                <i class="material-icons text-primary" style="font-size: 32px;">admin_panel_settings</i>
            </div>
            <h2 style="font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 8px; letter-spacing: -0.5px;">Selamat Datang Kembali</h2>
            <p style="font-size: 15px; color: #64748b;">Silakan login untuk mengelola sistem absensi</p>
        </div>

        <!-- Login Card -->
        <div class="card" style="border-radius: 24px; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 20px 50px rgba(0,0,0,0.08); overflow: hidden;">
            <div class="card-body" style="padding: 40px 36px;">
                <?= view('\App\Views\admin\_message_block') ?>
                
                <form action="<?= url_to('login') ?>" method="post" style="display: flex; flex-direction: column; gap: 24px;">
                    <?= csrf_field() ?>
                    
                    <!-- Login Field -->
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #334155; margin-bottom: 8px;">
                            <?= $config->validFields === ['email'] ? lang('Auth.email') : lang('Auth.emailOrUsername') ?>
                        </label>
                        <div style="position: relative; display: flex; align-items: center;">
                            <i class="material-icons text-primary" style="position: absolute; left: 16px; font-size: 20px; pointer-events: none;">person</i>
                            <input 
                                type="<?= $config->validFields === ['email'] ? 'email' : 'text' ?>" 
                                name="login" 
                                class="form-control" 
                                style="width: 100%; height: 48px; padding-left: 48px !important; padding-right: 16px !important; font-size: 15px; border-radius: 12px; background: #f8fafc; border: 1px solid <?php echo session('errors.login') ? '#ef4444' : '#cbd5e1'; ?>; color: #0f172a; box-shadow: none; transition: all 0.2s;" 
                                placeholder="Masukkan <?= $config->validFields === ['email'] ? 'email' : 'username' ?>"
                                autofocus
                            >
                        </div>
                        <?php if (session('errors.login')): ?>
                            <p style="margin-top: 8px; font-size: 13px; color: #ef4444; font-weight: 500;"><?= session('errors.login') ?></p>
                        <?php endif ?>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                            <label style="font-size: 14px; font-weight: 600; color: #334155; margin: 0;">Password</label>
                            <?php if ($config->activeResetter): ?>
                                <a href="<?= url_to('forgot') ?>" style="font-size: 13px; font-weight: 600; color: var(--primary); text-decoration: none;">Lupa password?</a>
                            <?php endif; ?>
                        </div>
                        <div style="position: relative; display: flex; align-items: center;">
                            <i class="material-icons text-primary" style="position: absolute; left: 16px; font-size: 20px; pointer-events: none;">lock</i>
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control" 
                                style="width: 100%; height: 48px; padding-left: 48px !important; padding-right: 16px !important; font-size: 15px; border-radius: 12px; background: #f8fafc; border: 1px solid <?php echo session('errors.password') ? '#ef4444' : '#cbd5e1'; ?>; color: #0f172a; box-shadow: none; transition: all 0.2s;" 
                                placeholder="••••••••"
                            >
                        </div>
                        <?php if (session('errors.password')): ?>
                            <p style="margin-top: 8px; font-size: 13px; color: #ef4444; font-weight: 500;"><?= session('errors.password') ?></p>
                        <?php endif ?>
                    </div>

                    <!-- Remember Me -->
                    <?php if ($config->allowRemembering): ?>
                        <div style="display: flex; align-items: center; margin-top: 4px;">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                id="remember"
                                style="width: 18px; height: 18px; cursor: pointer; border-radius: 6px; border: 1.5px solid #cbd5e1; accent-color: var(--primary);"
                                <?php if (old('remember')): ?> checked <?php endif ?>
                            >
                            <label for="remember" style="margin-left: 10px; font-size: 14px; color: #64748b; font-weight: 500; cursor: pointer; margin-bottom: 0;">
                                <?= lang('Auth.rememberMe') ?>
                            </label>
                        </div>
                    <?php endif; ?>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" style="width: 100%; height: 50px; border-radius: 12px; font-weight: 700; font-size: 16px; margin-top: 8px; background: var(--primary); border: none; box-shadow: 0 8px 20px rgba(124,58,237,0.25); display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer; transition: all 0.2s;">
                        <span><?= lang('Auth.loginAction') ?></span>
                        <i class="material-icons" style="font-size: 20px;">arrow_forward</i>
                    </button>
                </form>
            </div>
            
            <!-- Bottom decorative bar -->
            <div style="height: 6px; width: 100%; background: linear-gradient(90deg, var(--primary) 0%, #c084fc 100%);"></div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>