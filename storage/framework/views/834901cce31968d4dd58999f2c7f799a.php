

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <h3 class="mb-4">Edit Kategori</h3>

    <div class="card">
        <div class="card-header">Form Edit Kategori</div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.kategori.update', $kategori->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo e(old('nama', $kategori->nama)); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?php echo e(route('admin.kategori.index')); ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir\resources\views/admin/kategori/edit.blade.php ENDPATH**/ ?>