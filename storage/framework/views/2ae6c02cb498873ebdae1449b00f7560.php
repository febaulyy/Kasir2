<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coffee Shop App</title>

    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            color: #E7D4BB;
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


        /* NAVBAR */
        .navbar {
            background: #29281E;
        }
        .navbar-brand {
            font-weight: 800;
            color: #E7D4BB !important;
            letter-spacing: 1px;
        }
        .nav-link {
            font-weight: 600;
            color: #E7D4BB !important;
            opacity: 0.9;
        }

        .nav-link:hover {
            color: #FFF8EE !important; /* tetap krem terang, BUKAN hijau */
            opacity: 1;
            text-decoration: none;
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
            font-size: 3rem;
            font-weight: 800;
            color: #FFF8EE;
            margin-bottom: 15px;
        }
        .hero-desc {
            max-width: 620px;
            margin-bottom: 35px;
            color: #EEDFC4;
            font-size: 1.1rem;
        }

        /* BUTTON */
        .btn-main {
            background: #48252F;
            color: #E7D4BB;
            font-weight: 700;
            padding: 12px 34px;
            border-radius: 30px;
            transition: 0.25s;
            border: none;
        }
        .btn-main:hover {
            color: #E7D4BB;
            background: #29281E;
        }

        .btn-outline-main {
            border: 2px solid #E7D4BB;
            color: #E7D4BB;
            font-weight: 700;
            padding: 12px 34px;
            border-radius: 30px;
            transition: 0.25s;
            background: rgba(0, 0, 0, 0.25); /* kunci masalah */
        }

        .btn-outline-main:hover {
            background: #48252F;
            color: #E7D4BB;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                COFFEE CORNER
            </a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(url('/home')); ?>">Dashboard</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">Masuk</a>
                        </li>

                        <?php if(Route::has('register')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('register')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <h1 class="hero-title">Nikmati Kopi Favoritmu</h1>

        <p class="hero-desc">
            Aplikasi coffee shop sederhana untuk mengelola pesanan dan akses dashboard sesuai peran pengguna.  
            Silakan masuk untuk melanjutkan pengalaman ngopi digitalmu.
        </p>

        <div class="d-flex gap-3 mt-2">
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-main">Masuk</a>

                <?php if(Route::has('register')): ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-main">Daftar Akun</a>
                <?php endif; ?>
            <?php else: ?>
                <?php
                    $role = auth()->user()->role ?? 'user';
                    $dashboardUrl = $role === 'admin' ? url('/admin/dashboard') : url('/user/dashboard');
                ?>
                <a href="<?php echo e($dashboardUrl); ?>" class="btn btn-main">Buka Dashboard</a>
            <?php endif; ?>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/welcome.blade.php ENDPATH**/ ?>