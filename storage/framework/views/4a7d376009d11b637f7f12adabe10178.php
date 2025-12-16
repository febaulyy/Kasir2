

<?php $__env->startSection('content'); ?>
<div class="container-fluid d-flex flex-wrap">

    <!-- KONTEN UTAMA -->
    <div class="flex-grow-1">
        <h3 class="mb-4">Edit Produk</h3>

        <div class="card">
            <div class="card-header">Form Edit Produk</div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.produk.update', $produk->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Nama Produk</label>
                            <input type="text" name="nama" class="form-control"
                                   value="<?php echo e(old('nama', $produk->nama)); ?>" required>
                        </div>

                        <div class="col-md-3">
                            <label>Harga</label>
                            <input type="number" name="harga" class="form-control"
                                   value="<?php echo e(old('harga', $produk->harga)); ?>" required>
                        </div>

                        <div class="col-md-3">
                            <label>Stok</label>
                            <input type="number" name="stock" class="form-control"
                                   value="<?php echo e(old('stock', $produk->stock)); ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k->id); ?>"
                                        <?php echo e((string) old('kategori_id', $produk->kategori_id) === (string) $k->id ? 'selected' : ''); ?>>
                                        <?php echo e($k->nama); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required><?php echo e(old('deskripsi', $produk->deskripsi)); ?></textarea>
                        </div>

                        <div class="col-md-6">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control">
                            <?php if($produk->foto): ?>
                                <img src="<?php echo e(asset('storage/'.$produk->foto)); ?>" alt="Foto Produk" width="100" class="mt-2 rounded">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir\resources\views/admin/produk/edit.blade.php ENDPATH**/ ?>