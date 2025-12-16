<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi</title>

    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* NAVBAR */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e5e5;
        }
        .navbar-brand {
            font-weight: 800;
            color: #333 !important;
        }
        .nav-link {
            font-weight: 600;
            color: #555 !important;
        }
        .nav-link:hover {
            color: #000 !important;
        }

        /* HERO */
        .hero {
            min-height: calc(100vh - 80px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            text-align: center;
        }
        .hero-title {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 15px;
        }
        .hero-desc {
            max-width: 600px;
            margin-bottom: 30px;
            color: #555;
            font-size: 1.1rem;
        }

        /* BUTTON */
        .btn-main {
            background: #0d6efd;
            color: #fff;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 6px;
            transition: 0.25s;
        }
        .btn-main:hover {
            background: #0b5ed7;
        }
        .btn-outline-main {
            border: 2px solid #0d6efd;
            color: #0d6efd;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 6px;
            transition: 0.25s;
        }
        .btn-outline-main:hover {
            background: #eef4ff;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                Aplikasi
            </a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(url('/home')); ?>">Dashboard</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a>
                        </li>

                        <?php if(Route::has('register')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <h1 class="hero-title">Selamat Datang</h1>

        <p class="hero-desc">
            Sistem sederhana ini menyediakan akses ke dashboard sesuai role pengguna.  
            Login untuk melanjutkan.
        </p>

        <div class="d-flex gap-3 mt-2">
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-main">Login</a>

                <?php if(Route::has('register')): ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-main">Register</a>
                <?php endif; ?>
            <?php else: ?>
                <?php
                    $role = auth()->user()->role ?? 'user';
                    $dashboardUrl = $role === 'admin' ? url('/admin/dashboard') : url('/user/dashboard');
                ?>
                <a href="<?php echo e($dashboardUrl); ?>" class="btn btn-main">Masuk ke Dashboard</a>
            <?php endif; ?>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Kasir\resources\views/welcome.blade.php ENDPATH**/ ?>