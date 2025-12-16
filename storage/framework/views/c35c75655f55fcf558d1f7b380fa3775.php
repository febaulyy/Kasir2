<?php $__env->startSection('content'); ?>

<style>
    .login-bg {
        min-height: 100vh;
        background-image:
            linear-gradient(
                rgba(16,18,17,0.65),
                rgba(16,18,17,0.65)
            ),
            url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* CARD LOGIN TRANSPARAN */
    .login-card {
        background: rgba(231, 212, 187, 0.65); /* lebih transparan */
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.35);
    }

    /* Input biar nyatu */
    .login-card .form-control {
        background: rgba(255,255,255,0.85);
        border-radius: 14px;
        border: 1px solid #cbb89f;
    }
</style>

<div class="login-bg d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">

                <div class="card border-0 rounded-4 login-card">
                    <div class="card-header text-center border-0 rounded-top-4" style="background:#29281E;">
                        <h4 class="mb-0 fw-bold" style="color:#E7D4BB;">
                            Masuk ke Coffee Corner
                        </h4>
                        <small style="color:#cfc2a8;">Nikmati pengalaman ngopi digital</small>
                    </div>

                    <div class="card-body px-4 py-4">
                        <form method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>

                            
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input id="email" type="email"
                                    class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input id="password" type="password"
                                    class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="password" required>

                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                <label class="form-check-label">Ingat saya</label>
                            </div>

                            
                            <div class="d-grid gap-2">
                                <button type="submit"
                                    class="btn fw-bold rounded-pill"
                                    style="background:#48252F;color:#E7D4BB;">
                                    Masuk
                                </button>

                                <?php if(Route::has('password.request')): ?>
                                    <a class="text-center mt-2 text-decoration-none"
                                       style="color:#48252F;"
                                       href="<?php echo e(route('password.request')); ?>">
                                        Lupa password?
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center mt-3" style="color:#E7D4BB;font-size:0.9rem;">
                    © Coffee Corner — Brew your day better
                </p>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/auth/login.blade.php ENDPATH**/ ?>