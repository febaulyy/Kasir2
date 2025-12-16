<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        body {
            background: #f5f6fa;
            font-family: 'Nunito', sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #2f3542;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }

        .sidebar a {
            color: #dfe4ea;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: 600;
        }

        .sidebar a:hover {
            background: #57606f;
            color: #fff;
        }

        .content {
            margin-left: 250px;
            padding: 25px;
        }

        .topbar {
            background: #fff;
            padding: 15px 20px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="text-center mb-4">Admin Panel</h4>

        <a href="<?php echo e(route('admin.dashboard')); ?>">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="<?php echo e(route('admin.produk.index')); ?>">
            <i class="bi bi-box-seam me-2"></i> Produk
        </a>

        <a href="<?php echo e(route('admin.kategori.index')); ?>">
            <i class="bi bi-folder2-open me-2"></i> Kategori
        </a>

        <a href="<?php echo e(route('admin.pesanan.index')); ?>">
            <i class="bi bi-clock-history me-2"></i> Pesanan Masuk
        </a>

        <!-- <a href="<?php echo e(route('admin.transaksi.index')); ?>">
            <i class="bi bi-credit-card-2-front me-2"></i> Transaksi
        </a> -->

        <a href="<?php echo e(route('logout')); ?>"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>

        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
    </div>


    <!-- MAIN CONTENT -->
    <div class="content">
        <div class="topbar d-flex justify-content-between">
            <h5 class="mb-0">Admin Dashboard</h5>
            <span><?php echo e(Auth::user()->name); ?></span>
        </div>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Kasir\resources\views/layouts/admin.blade.php ENDPATH**/ ?>