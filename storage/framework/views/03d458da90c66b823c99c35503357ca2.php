<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Coffee Corner</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>
<body>
<div id="app">

    <!-- NAVBAR (SAMA DENGAN WELCOME) -->
    <nav class="navbar navbar-expand-md shadow-sm" style="background:#29281E;">
        <div class="container">
            <a class="navbar-brand fw-bold"
               style="color:#E7D4BB; letter-spacing:1px;"
               href="<?php echo e(url('/')); ?>">
                COFFEE CORNER
            </a>

            <button class="navbar-toggler bg-light" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <?php if(auth()->guard()->guest()): ?>
                        <?php if(Route::has('login')): ?>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold"
                                   style="color:#E7D4BB;"
                                   href="<?php echo e(route('login')); ?>">
                                    Masuk
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(Route::has('register')): ?>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold"
                                   style="color:#E7D4BB;"
                                   href="<?php echo e(route('register')); ?>">
                                    Daftar
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown"
                               class="nav-link dropdown-toggle fw-semibold"
                               style="color:#E7D4BB;"
                               href="#"
                               role="button"
                               data-bs-toggle="dropdown">
                                <?php echo e(Auth::user()->name); ?>

                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item"
                                   href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form"
                                      action="<?php echo e(route('logout')); ?>"
                                      method="POST"
                                      class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="py-0">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/layouts/app.blade.php ENDPATH**/ ?>