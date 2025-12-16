

<?php $__env->startSection('content'); ?>

<style>
    body {
        background: #f2f2f7 !important;
    }
    
    .btn-produk {
        background-color: #333 !important;
        border-color: #333 !important;
    }

    .btn-produk:hover {
        background-color: #555 !important;
        border-color: #555 !important;
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-title {
        font-weight: 600;
        color: #222;
    }

    .card-text {
        color: #555;
    }

    #search, #filterKategori {
        border-radius: 10px;
        border: 1px solid #ccc;
    }

    #produkList .card-img-top {
        background: #eee;
    }

    /* Blur jika stok habis */
    .img-blur {
        filter: grayscale(80%) brightness(70%);
    }
</style>

<div class="container my-4">

<?php if(session('error')): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo e(session('error')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo e(session('success')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

    <!-- Search Produk -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="search" class="form-control" placeholder="Cari produk...">
        </div>

        <div class="col-md-4">
            <select id="filterKategori" class="form-select">
                <option value="">-- Semua Kategori --</option>
                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="row" id="produkList">
        <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4 produk-item" data-kategori="<?php echo e($item->kategori_id); ?>">
            <div class="card h-100 shadow-sm position-relative">
                
                <?php if($item->foto): ?>
                    <img 
                        src="<?php echo e(asset('storage/'.$item->foto)); ?>" 
                        class="card-img-top <?php echo e($item->stock <= 0 ? 'img-blur' : ''); ?>"
                        style="height:180px; object-fit:cover;">
                <?php endif; ?>

                
                <?php if($item->stock <= 0): ?>
                <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1 rounded-bottom-end fw-bold">
                    Habis
                </div>
                <?php endif; ?>
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo e($item->nama); ?></h5>
                    <p class="card-text mb-1">Rp <?php echo e(number_format($item->harga,0,',','.')); ?></p>

                    
                    <?php if($item->stock <= 0): ?>
                        <p class="card-text text-danger fw-bold mb-2 d-none">Stok: Habis</p>
                    <?php else: ?> 
                        <p class="card-text text-success fw-semibold mb-2 d-none">Stok: <?php echo e($item->stock); ?></p>
                    <?php endif; ?>

                    <p class="card-text flex-grow-1"><?php echo e($item->deskripsi); ?></p>

                    <div class="mt-auto">

                        
                        <?php if($item->stock > 0): ?>
                            <div class="d-flex gap-2">

                                
                                <form action="<?php echo e(route('user.cart.add', $item->id)); ?>" method="POST" class="flex-grow-1">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-dark w-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-shopping-cart me-2"></i> Tambahkan ke Keranjang
                                    </button>
                                </form>

                                
                                <form action="<?php echo e(route('user.checkout.now', $item->id)); ?>" method="POST" class="flex-grow-1 d-none">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success w-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-bolt me-2"></i> Beli
                                    </button>
                                </form>

                            </div>

                        
                        <?php else: ?>
                            <button class="btn btn-secondary w-100" disabled>
                                Tidak Tersedia
                            </button>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <p class="text-center">Belum ada produk tersedia.</p>
        </div>
        <?php endif; ?>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById('search');
    searchInput.addEventListener('keyup', function() {
        let query = this.value.toLowerCase();
        document.querySelectorAll('.produk-item').forEach(item => {
            let text = item.textContent.toLowerCase();
            item.style.display = text.includes(query) ? '' : 'none';
        });
    });

    const filterSelect = document.getElementById('filterKategori');
    filterSelect.addEventListener('change', function() {
        let kategori = this.value.trim();
        
        document.querySelectorAll('.produk-item').forEach(item => {
            let itemKategori = item.dataset.kategori;

            if (kategori === "" || itemKategori === kategori) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    });

});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir\resources\views/user/dashboard.blade.php ENDPATH**/ ?>