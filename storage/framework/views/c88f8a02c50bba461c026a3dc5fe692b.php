<?php $__env->startSection('content'); ?>

<style>
    .register-bg {
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

    .register-card {
        background: rgba(231, 212, 187, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.35);
    }

    .register-card .form-control {
        background: rgba(255,255,255,0.85);
        border-radius: 14px;
        border: 1px solid #cbb89f;
    }
</style>

<div class="register-bg d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">

                <div class="card border-0 rounded-4 register-card">
                    <div class="card-header text-center border-0 rounded-top-4" style="background:#29281E;">
                        <h4 class="mb-0 fw-bold" style="color:#E7D4BB;">
                            Daftar Akun Coffee Corner
                        </h4>
                        <small style="color:#cfc2a8;">Mulai pengalaman ngopi digitalmu</small>
                    </div>

                    <div class="card-body px-4 py-4">
                        <form method="POST" action="<?php echo e(route('register')); ?>">
                            <?php echo csrf_field(); ?>

                            
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nama</label>
                                <input id="name" type="text"
                                    class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php $__errorArgs = ['name'];
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
                                    name="email" value="<?php echo e(old('email')); ?>" required>

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

                            
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label fw-semibold">
                                    Konfirmasi Password
                                </label>
                                <input id="password-confirm" type="password"
                                    class="form-control"
                                    name="password_confirmation" required>
                            </div>

                            
                            <div class="d-grid gap-2">
                                <button type="submit"
                                    class="btn fw-bold rounded-pill"
                                    style="background:#48252F;color:#E7D4BB;">
                                    Daftar
                                </button>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/auth/register.blade.php ENDPATH**/ ?>