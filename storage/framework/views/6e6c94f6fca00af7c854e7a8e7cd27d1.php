
<?php $__env->startSection('title', 'Keranjang Belanja'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('error')): ?>
<div class="alert alert-warning">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>

<style>
    body {
        background: #f4f1ec !important; /* krem lembut */
    }

    .cart-wrapper {
        background: #f4f1ec;
        padding: 10px 0;
    }

    .cart-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 18px;
        display: flex;
        gap: 16px;
        align-items: center;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        margin-bottom: 18px;
        border: 1px solid #e5dccd;
    }

    .cart-img {
        width: 110px;
        height: 110px;
        border-radius: 12px;
        object-fit: cover;
    }

    .cart-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .cart-actions {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-end;
        height: 110px;
    }

    .qty-box {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f6f2ea;
        padding: 6px 12px;
        border-radius: 10px;
        border: 1px solid #d6c8b5;
    }

    .qty-btn {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        border: 1px solid #c7b299;
        background: #ffffff;
        color: #4a2c2a;
        font-weight: bold;
    }

    .qty-btn:hover {
        background: #4a2c2a;
        color: #ffffff;
    }

    .total-price {
        font-weight: 700;
        color: #4a2c2a; /* coklat coffee */
    }

    .btn-danger {
        background-color: #8b3a3a;
        border-color: #8b3a3a;
    }

    .btn-danger:hover {
        background-color: #6f2c2c;
        border-color: #6f2c2c;
    }

    .btn-success {
        background-color: #4a2c2a;
        border-color: #4a2c2a;
    }

    .btn-success:hover {
        background-color: #2e1b19;
        border-color: #2e1b19;
    }

</style>

<div class="cart-wrapper">

    <div class="container py-4">

        <h4 class="fw-bold mb-4" style="color:#2e1b19;">
            Keranjang Belanja
        </h4>

        <?php if(empty($cart) || count($cart) === 0): ?>

            <div class="alert alert-info text-center py-4 rounded-4">
                <i class="bi bi-cart-x fs-1 d-block mb-3"></i>
                Keranjang kamu masih kosong.
            </div>

        <?php else: ?>

            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="cart-card">

                <img src="<?php echo e(asset('storage/'.$item['foto'])); ?>" class="cart-img">

                <div class="cart-info">
                    <div class="fw-semibold mb-1" style="color:#2e1b19;">
                        <?php echo e($item['nama']); ?>

                    </div>
                    <div class="text-muted mb-2">
                        Rp <?php echo e(number_format($item['harga'], 0, ',', '.')); ?>

                    </div>

                    <div class="qty-box">
                        <form action="<?php echo e(route('user.cart.update', $id)); ?>" method="POST" class="m-0">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="action" value="minus">
                            <button class="qty-btn">−</button>
                        </form>

                        <span class="fw-bold"><?php echo e($item['qty']); ?></span>

                        <form action="<?php echo e(route('user.cart.update', $id)); ?>" method="POST" class="m-0">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="action" value="plus">
                            <button class="qty-btn">+</button>
                        </form>
                    </div>
                </div>

                <div class="cart-actions">
                    <div class="total-price">
                        Rp <?php echo e(number_format($item['harga'] * $item['qty'], 0, ',', '.')); ?>

                    </div>

                    <form action="<?php echo e(route('user.cart.remove', $id)); ?>" method="POST" class="m-0">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>

            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="d-flex justify-content-between align-items-center mt-3 p-3 bg-white rounded-4 shadow-sm border">
                <h5 class="fw-bold m-0" style="color:#2e1b19;">
                    Total Bayar:
                    <span style="color:#4a2c2a;">
                        Rp <?php echo e(number_format(collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']), 0, ',', '.')); ?>

                    </span>
                </h5>

                <form action="<?php echo e(route('user.checkout')); ?>" method="GET">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success btn-lg px-4">
                        <i class="bi bi-credit-card me-1"></i> Checkout
                    </button>
                </form>

            </div>

        <?php endif; ?>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/user/cart.blade.php ENDPATH**/ ?>