

<?php $__env->startSection('content'); ?>

<style>
    body {
        background: #f4f1ec !important;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
    }

    /* HEADER */
    .coffee-header {
        background: #48252F;
        color: #E7D4BB;
        padding: 2rem 0;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.18);
    }

    .coffee-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #E7D4BB;
    }

    .coffee-subtitle {
        font-size: 1.05rem;
        color: #e0c9aa;
    }

    /* SEARCH */
    .search-section {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.6rem;
        margin-bottom: 2rem;
        border: 1px solid #d1c7b8;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .search-input,
    .filter-select {
        border-radius: 14px;
        border: 1px solid #d1c7b8;
        padding: 10px 14px;
        background: #f9f7f3;
    }

    .search-input:focus,
    .filter-select:focus {
        border-color: #48252F;
        box-shadow: 0 0 0 2px rgba(72,37,47,0.15);
        background: #fff;
    }

    /* GRID */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.6rem;
    }

    /* CARD */
    .product-card {
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 22px rgba(0,0,0,0.1);
        transition: 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 30px rgba(0,0,0,0.15);
    }

    .product-image {
        height: 180px;
        background: #eee;
        position: relative;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* BADGE */
    .category-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #48252F;
        color: #E7D4BB;
        padding: 4px 10px;
        border-radius: 14px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .stock-out {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #b02a37;
        color: #fff;
        padding: 4px 10px;
        border-radius: 14px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* INFO */
    .product-info {
        padding: 1.2rem;
    }

    .product-name {
        font-size: 1.05rem;
        font-weight: 600;
        color: #29281E;
        margin-bottom: 6px;
    }

    .product-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #48252F;
        margin-bottom: 12px;
    }

    /* BUTTON */
    .btn-coffee {
        background: #48252F;
        color: #E7D4BB;
        border-radius: 14px;
        font-weight: 600;
        width: 100%;
    }

    .btn-coffee:hover {
        background: #29281E;
        color: #E7D4BB;
    }

    .btn-disabled {
        background: #e0e0e0 !important;
        color: #777 !important;
        border: none !important;
    }

    /* EMPTY */
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #48252F;
    }
</style>

<div class="container-fluid px-4">

    <?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    
    <div class="coffee-header text-center">
        <h1 class="coffee-title mb-2">
            Selamat Datang
        </h1>
        <p class="coffee-subtitle mb-0">
            Nikmati kopi terbaik bersama <?php echo e(Auth::user()->name); ?>

        </p>
    </div>

    
    <div class="search-section">
        <div class="row g-3">
            <div class="col-md-8">
                <input type="text" id="search" class="form-control search-input" placeholder="Cari produk...">
            </div>
            <div class="col-md-4">
                <select id="filterKategori" class="form-select filter-select">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>

    
    <div class="product-grid" id="produkList">
        <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="produk-item" data-kategori="<?php echo e($item->kategori_id); ?>">
            <div class="product-card">

                <div class="product-image">
                    <?php if($item->foto): ?>
                        <img src="<?php echo e(asset('storage/'.$item->foto)); ?>">
                    <?php endif; ?>

                    <div class="category-badge">
                        <?php echo e($item->kategori->nama); ?>

                    </div>

                    <?php if($item->stock <= 0): ?>
                        <div class="stock-out">Habis</div>
                    <?php endif; ?>
                </div>

                <div class="product-info">
                    <div class="product-name"><?php echo e($item->nama); ?></div>
                    <div class="product-price">
                        Rp <?php echo e(number_format($item->harga,0,',','.')); ?>

                    </div>

                    <?php if($item->stock > 0): ?>
                        <form action="<?php echo e(route('user.cart.add', $item->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-coffee">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    <?php else: ?>
                        <button class="btn btn-disabled w-100" disabled>
                            Tidak Tersedia
                        </button>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state">
            <h5>Belum ada produk tersedia</h5>
        </div>
        <?php endif; ?>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    document.getElementById('search').addEventListener('keyup', function() {
        let q = this.value.toLowerCase();
        document.querySelectorAll('.produk-item').forEach(item => {
            item.style.display = item.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    document.getElementById('filterKategori').addEventListener('change', function() {
        let k = this.value;
        document.querySelectorAll('.produk-item').forEach(item => {
            item.style.display = (k === "" || item.dataset.kategori === k) ? "" : "none";
        });
    });

});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/user/dashboard.blade.php ENDPATH**/ ?>