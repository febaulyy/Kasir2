
<?php $__env->startSection('title', 'Konfirmasi Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3>Konfirmasi Pesanan</h3>

    <p>Status: 
        <strong class="<?php echo e($order->status == 'pending' ? 'text-warning' : 'text-success'); ?>">
            <?php echo e(ucfirst($order->status)); ?>

        </strong>
    </p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td>
        <img src="<?php echo e(asset('storage/'.$item->gambar_produk)); ?>" width="50">
        <?php echo e($item->nama_produk); ?>

    </td>
    <td><?php echo e($item->qty); ?></td>
    <td>Rp <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?></td>
    <td>Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>

    <h5 class="text-end">
        Total: <strong>Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></strong>
    </h5>

    <p class="mt-3">Silakan tunggu admin menyetujui pesanan...</p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir\resources\views/user/konfirmasi.blade.php ENDPATH**/ ?>