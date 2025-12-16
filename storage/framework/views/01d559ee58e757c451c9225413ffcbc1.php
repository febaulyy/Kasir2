

<?php $__env->startSection('content'); ?>

<style>
body {
    background: #f4f1ec !important;
    font-family: 'Poppins', sans-serif;
}

/* WRAPPER */
.page {
    max-width: 1200px;
    margin: auto;
    padding: 2rem 1rem;
}

/* HEADER */
.header {
    background: #48252F;
    color: #E7D4BB;
    padding: 1.5rem 2rem;
    border-radius: 16px;
    margin-bottom: 1.5rem;
}

/* FILTER BAR */
.filter-bar {
    background: #fff;
    border-radius: 16px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: 1px solid #d1c7b8;
    display: flex;
    gap: 1rem;
}

/* INPUT */
.search-input, .filter-select {
    border-radius: 14px;
    border: 1px solid #d1c7b8;
    padding: 10px 14px;
    background: #f9f7f3;
}

/* LIST */
.product-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* ROW CARD */
.product-row {
    display: flex;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
}

/* IMAGE */
.product-row img {
    width: 160px;
    height: 140px;
    object-fit: cover;
}

/* CONTENT */
.product-content {
    flex: 1;
    padding: 1rem 1.2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* LEFT INFO */
.product-info h6 {
    margin: 0;
    font-weight: 600;
}

.product-info span {
    color: #48252F;
    font-weight: 700;
}

/* BUTTON */
.btn-coffee {
    background: #48252F;
    color: #E7D4BB;
    border-radius: 12px;
    font-weight: 600;
}

.btn-disabled {
    background: #e0e0e0;
    color: #777;
    border-radius: 12px;
}
</style>

<div class="page">

    <div class="header">
        <h4>Selamat Datang</h4>
        <small>Nikmati kopi terbaik bersama <?php echo e(Auth::user()->name); ?></small>
    </div>

    <div class="filter-bar">
        <input type="text" id="search" class="form-control search-input" placeholder="Cari produk...">
        <select id="filterKategori" class="form-select filter-select">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="product-list">
        <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="produk-item product-row" data-kategori="<?php echo e($item->kategori_id); ?>">

            <?php if($item->foto): ?>
                <img src="<?php echo e(asset('storage/'.$item->foto)); ?>">
            <?php endif; ?>

            <div class="product-content">
                <div class="product-info">
                    <h6><?php echo e($item->nama); ?></h6>
                    <small><?php echo e($item->kategori->nama); ?></small><br>
                    <span>Rp <?php echo e(number_format($item->harga,0,',','.')); ?></span><br>

                    <?php if($item->stock <= 0): ?>
                        <small class="text-danger">Stok Habis</small>
                    <?php else: ?>
                        <small class="text-success">Stok: <?php echo e($item->stock); ?></small>
                    <?php endif; ?>
                </div>

                <div>
                    <?php if($item->stock > 0): ?>
                        <form action="<?php echo e(route('user.cart.add', $item->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-coffee">
                                +
                            </button>
                        </form>
                    <?php else: ?>
                        <button class="btn btn-disabled" disabled>
                            Tidak Tersedia
                        </button>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>

<script>
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
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/user/dashboard.blade.php ENDPATH**/ ?>