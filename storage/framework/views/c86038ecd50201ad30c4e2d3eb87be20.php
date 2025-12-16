

<?php $__env->startSection('title', 'Riwayat Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4" style="max-width: 800px;">

    <h2 class="mb-4 fw-bold">Riwayat Pesanan</h2>

    <?php if($orders->isEmpty()): ?>
        <div class="alert alert-info text-center">
            Belum ada pesanan.
        </div>
    <?php else: ?>
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
                $firstItem = $order->details->first();
            ?>

            <div class="card mb-3 shadow-sm border-0" 
                style="border-radius:14px; background:#fff;">
                <div class="card-body">

                    
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div></div> 
                        <span class="px-2 py-1 small"
                            style="color:#ff5f00; font-weight:600;">
                            Selesai
                        </span>
                    </div>

                    
                    <?php if($firstItem): ?>

                        <?php
                            $foto = $firstItem->foto_produk 
                                    ? 'storage/'.$firstItem->foto_produk
                                    : ($firstItem->produk 
                                        ? 'storage/'.$firstItem->produk->foto
                                        : 'https://via.placeholder.com/80');
                        ?>

                        <div class="d-flex gap-3 mt-n2">

                            
                            <img src="<?php echo e(asset($foto)); ?>"
                                class="rounded"
                                style="width: 80px; height: 80px; object-fit: cover;">

                            <div class="flex-grow-1">

                                
                                <div class="fw-semibold" style="font-size: 0.95rem; margin-top:2px;">
                                    <?php echo e($firstItem->nama_produk ?? ($firstItem->produk->nama ?? 'Produk')); ?>

                                </div>

                                
                                <div class="text-muted small mt-1">
                                    Rp <?php echo e(number_format($firstItem->harga_satuan, 0, ',', '.')); ?>

                                    × <?php echo e($firstItem->qty); ?>

                                </div>

                                
                                <?php if($order->details->count() > 1): ?>
                                    <div class="text-muted small">
                                        +<?php echo e($order->details->count() - 1); ?> produk lainnya
                                    </div>
                                <?php endif; ?>

                                
                                <div class="text-muted small mt-1">
                                    <?php echo e($order->created_at->timezone('Asia/Jakarta')->format('d M Y H:i')); ?> WIB
                                </div>

                            </div>

                        </div>
                    <?php endif; ?>

                    <hr>

                    
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="fw-bold" style="font-size:0.95rem;">
                            Total Harga:
                            <span class="text-danger">
                                Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?>

                            </span>
                        </div>

                        <a href="<?php echo e(route('user.struk', $order->id)); ?>"
                            class="btn btn-sm btn-outline-primary"
                            style="border-radius:8px;">
                            Cetak Struk
                        </a>

                    </div>

                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/user/riwayat.blade.php ENDPATH**/ ?>