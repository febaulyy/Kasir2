

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <!-- Judul -->
    <h3 class="mb-4">Dashboard Overview</h3>

    <!-- Kartu Statistik -->
    <div class="row g-3">

        <div class="col-md-4">
            <div class="p-3 bg-white shadow-sm rounded">
                <h6>Total Produk</h6>
                <h3 class="fw-bold"><?php echo e($totalProduk); ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 bg-white shadow-sm rounded">
                <h6>Total Pesanan Masuk</h6>
                <h3 class="fw-bold"><?php echo e($totalPesanan); ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 bg-white shadow-sm rounded">
                <h6>Transaksi Hari Ini</h6>
                <h3 class="fw-bold">Rp <?php echo e(number_format($transaksiHariIni, 0, ',', '.')); ?></h3>
            </div>
        </div>

    </div>

</div>

<!-- AJAX Script -->
<script>
    document.getElementById('search').addEventListener('keyup', function() {
        let q = this.value;

        if (q.length < 2) {
            document.getElementById('searchResult').style.display = "none";
            return;
        }

        // Dummy data sementara
        let dummy = [
            "Produk: Contoh 1",
            "Produk: Contoh 2",
            "Pesanan #INV00001",
            "Pesanan #INV00002",
        ];

        let list = document.getElementById('resultList');
        list.innerHTML = "";

        dummy.forEach(item => {
            let li = document.createElement('li');
            li.className = "list-group-item";
            li.textContent = item;
            list.appendChild(li);
        });

        document.getElementById('searchResult').style.display = "block";
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>