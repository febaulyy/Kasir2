<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'User Dashboard'); ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .badge-cart {
            position: absolute;
            top: -5px;
            right: -10px;
            font-size: 0.7rem;
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 8px;
        }
        .card-product img {
            max-height: 150px;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center fw-bold" href="<?php echo e(route('user.dashboard')); ?>">
                <i class="bi bi-person-circle fs-3 me-2 text-primary"></i>
                <?php echo e(Auth::user()->name); ?>

            </a>

            <!-- Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-4">

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('user.dashboard') ? 'active fw-semibold text-primary' : ''); ?>" 
                           href="<?php echo e(route('user.dashboard')); ?>">
                            <i class="bi bi-house-door me-1"></i> Home
                        </a>
                    </li>

                    <li class="nav-item position-relative">
                        <a class="nav-link <?php echo e(request()->routeIs('user.cart') ? 'active fw-semibold text-primary' : ''); ?>" 
                           href="<?php echo e(route('user.cart.index')); ?>">
                            <i class="bi bi-cart3 me-1"></i> Cart
                            <?php if(session('cart') && count(session('cart')) > 0): ?>
                                <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle px-2 py-1">
                                    <?php echo e(count(session('cart'))); ?>

                                </span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('user.riwayat') ? 'active fw-semibold text-primary' : ''); ?>" 
                           href="<?php echo e(route('user.riwayat')); ?>">
                            <i class="bi bi-clock-history me-1"></i> Riwayat
                        </a>
                    </li>

                    <li class="nav-item ms-3">
                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary btn-sm px-3">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <div class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Kasir\resources\views/layouts/user.blade.php ENDPATH**/ ?>