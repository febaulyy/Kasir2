

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="fw-bold mb-4">Pesanan Masuk</h2>

    
    <form method="GET" class="d-flex gap-3 mb-4">
        <select name="filter" class="form-select" style="max-width: 200px;">
            <option value="">Semua</option>
            <option value="today" <?php echo e(request('filter') == 'today' ? 'selected' : ''); ?>>Hari Ini</option>
            <option value="yesterday" <?php echo e(request('filter') == 'yesterday' ? 'selected' : ''); ?>>Kemarin</option>
            <option value="date" <?php echo e(request('filter') == 'date' ? 'selected' : ''); ?>>Pilih Tanggal</option>
        </select>

        <input type="date" name="date" 
               value="<?php echo e(request('date')); ?>" 
               class="form-control"
               style="max-width: 200px;">

        <button class="btn btn-primary">Filter</button>
    </form>

    
    <?php if($orders->isEmpty()): ?>
        <div class="alert alert-info text-center">Tidak ada pesanan ditemukan.</div>
    <?php else: ?>

        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-3 shadow-sm border-0" style="border-radius: 14px;">
                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <div class="fw-semibold">User: <?php echo e($order->user->name); ?></div>
                        <div class="text-muted small">
                            <?php echo e($order->created_at->format('d M Y H:i')); ?>

                        </div>
                    </div>

                    <hr>

                    <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-between mb-2 small">
                            <div>
                                <?php echo e(optional($detail->produk)->nama ?? 'Produk sudah dihapus'); ?>

                                (ID: <?php echo e($detail->produk_id); ?>)
                                (<?php echo e($detail->qty); ?> × Rp <?php echo e(number_format($detail->harga_satuan, 0, ',', '.')); ?>)
                            </div>
                            <div>
                                Rp <?php echo e(number_format($detail->subtotal, 0, ',', '.')); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <div class="fw-bold">
                            Total: Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?>

                        </div>
                        <div class="text-muted small">
                            Metode: <?php echo e($order->metode_pembayaran ?? 'Tidak ada'); ?>

                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>

</div>


<script>
    const filterSelect = document.querySelector('select[name="filter"]');
    const dateInput = document.querySelector('input[name="date"]');

    function updateDateState() {
        if (filterSelect.value === 'date') {
            dateInput.disabled = false;
            dateInput.style.background = '#fff';
        } else {
            dateInput.disabled = true;
            dateInput.value = '';
            dateInput.style.background = '#e9ecef';
        }
    }

    filterSelect.addEventListener('change', updateDateState);

    updateDateState();
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/admin/pesanan/index.blade.php ENDPATH**/ ?>