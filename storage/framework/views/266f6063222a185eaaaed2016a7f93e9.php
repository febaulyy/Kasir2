

<?php $__env->startSection('content'); ?>
<div class="container-fluid d-flex">

    <!-- KONTEN UTAMA -->
    <div class="flex-grow-1 ms-4">
        <h3 class="mb-4">Kelola Kategori</h3>

        <!-- Form Tambah Kategori -->
        <div class="card mb-4">
            <div class="card-header">Tambah Kategori Baru</div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.kategori.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                </form>
            </div>
        </div>

        <!-- Tabel Kategori -->
        <div class="card">
            <div class="card-header">Daftar Kategori</div>
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($kategori->firstItem() + $index); ?></td>
                            <td><?php echo e($item->nama); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.kategori.edit', $item->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                                <form action="<?php echo e(route('admin.kategori.destroy', $item->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus kategori ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center">Belum ada kategori.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <?php echo e($kategori->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/admin/kategori/index.blade.php ENDPATH**/ ?>