
<?php $__env->startSection('title', 'Checkout'); ?>

<?php $__env->startSection('content'); ?>

<style>
    body {
        background: #f2f6ff !important;
    }

    .section-box {
        background: #fff;
        padding: 18px;
        border-radius: 14px;
        margin-bottom: 18px;
        border: 1px solid #dbe4ff;
        box-shadow: 0 2px 5px rgba(0, 56, 255, 0.05);
    }

    .product-item {
        display: flex;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px solid #eef2ff;
    }
    .product-item:last-child {
        border-bottom: none;
    }

    .product-img {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #d7e3ff;
    }

    .payment-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .pay-option {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border: 1px solid #dbe4ff;
        border-radius: 12px;
        background: #f8faff;
        transition: 0.2s ease;
    }

    .pay-option:hover {
        background: #eef4ff;
        border-color: #a8c1ff;
    }

    .pay-option input {
        transform: scale(1.3);
        margin-right: 6px;
    }

    .pay-label {
        font-size: 15px;
        font-weight: 600;
        color: #1a2c7e;
    }

    .qris-box {
        margin-top: 14px;
        padding: 16px;
        border-radius: 14px;
        background: #f0f4ff;
        border: 1px solid #c8d6ff;
        text-align: center;
        display: none;
    }

    .qris-box img {
        width: 200px;
        border-radius: 10px;
        border: 1px solid #dbe4ff;
    }

    .total-box {
        background: #fff;
        padding: 18px;
        border-top: 1px solid #d0dcff;
        box-shadow: 0 -2px 5px rgba(0,0,0,0.08);
        border-radius: 14px;
    }

    .btn-blue {
        background: #2458ff !important;
        border-color: #2458ff !important;
        font-weight: 600;
        border-radius: 10px;
        color: white;
    }

    .btn-blue:hover {
        background: #507bff !important;
    }

    .text-blue {
        color: #2458ff;
    }
</style>

<div class="container mt-3 mb-5">

    <!-- PRODUK -->
    <div class="section-box">
        <h5 class="fw-bold mb-3" style="color:#1a2c7e;">Produk Dipesan</h5>

        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="product-item">
            <img src="<?php echo e(asset('storage/'.$item['foto'])); ?>" class="product-img">
            <div class="flex-grow-1">
                <div class="fw-semibold"><?php echo e($item['nama']); ?></div>
                <small class="text-muted">Qty: <?php echo e($item['qty']); ?></small>
            </div>
            <div class="fw-bold text-blue">
                Rp <?php echo e(number_format($item['harga'] * $item['qty'], 0, ',', '.')); ?>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- FORM MULAI -->
    <form action="<?php echo e(route('user.checkout.process')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <!-- PEMBAYARAN -->
        <div class="section-box">
            <h5 class="fw-bold mb-3" style="color:#1a2c7e;">Metode Pembayaran</h5>

            <div class="payment-list">
                <label class="pay-option">
                    <input type="radio" name="metode_pembayaran" value="Transfer Bank" checked>
                    <span class="pay-label">Transfer Bank</span>
                </label>

                <label class="pay-option">
                    <input type="radio" name="metode_pembayaran" value="E-Wallet">
                    <span class="pay-label">E-Wallet</span>
                </label>

                <label class="pay-option">
                    <input type="radio" name="metode_pembayaran" value="COD">
                    <span class="pay-label">COD - Bayar di Tempat</span>
                </label>
            </div>

            <div id="qrisBox" class="qris-box d-none">
                <h6 class="fw-bold mb-2" style="color:#1a2c7e;">Scan QRIS untuk Pembayaran</h6>
                <img src="<?php echo e(asset('assets/qris.jpg')); ?>" alt="QRIS">
            </div>
        </div>

        <!-- TOTAL & BUTTON -->
        <div class="total-box mt-3">
            <div class="d-flex justify-content-between mb-2">
                <span class="fw-semibold">Total Pembayaran</span>
                <span class="fw-bold text-blue">
                    Rp <?php echo e(number_format(collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']), 0, ',', '.')); ?>

                </span>
            </div>

            <button class="btn btn-blue w-100 py-2 fs-5">
                Buat Pesanan
            </button>
        </div>
    </form>
</div>

<script>
function updateQris() {
    let metode = document.querySelector("input[name='metode_pembayaran']:checked").value;
    document.getElementById("qrisBox").style.display = (metode === "COD") ? "none" : "block";
}

document.querySelectorAll("input[name='metode_pembayaran']").forEach(radio => {
    radio.addEventListener("change", updateQris);
});

updateQris();
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir\resources\views/user/checkout.blade.php ENDPATH**/ ?>