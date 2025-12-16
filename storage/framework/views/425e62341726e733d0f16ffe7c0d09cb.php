

<?php $__env->startSection('content'); ?>
<div class="container-fluid d-flex flex-wrap">

    <!-- KONTEN UTAMA -->
    <div class="flex-grow-1">
        <h3 class="mb-4">Kelola Produk</h3>

        <!-- Search AJAX -->
        <div class="mb-4">
            <input type="text" id="search" class="form-control" placeholder="Cari produk...">
        </div>

        <!-- Form Tambah Produk -->
        <div class="card mb-4">
            <div class="card-header">Tambah Produk Baru</div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.produk.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Nama Produk</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>Stok</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="2" required></textarea>
                        </div>

                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Tambah Produk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Produk -->
        <div class="card">
            <div class="card-header">Daftar Produk</div>
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle" id="produkTable">
                    <thead class="table-light">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="produkList">
                        <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($item->foto): ?>
                                     <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="Foto Produk" width="60" class="rounded">
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($item->nama); ?></td>
                            <td><?php echo e($item->kategori->nama ?? '-'); ?></td>
                            <td>Rp <?php echo e(number_format($item->harga,0,',','.')); ?></td>
                            <td><?php echo e($item->stock); ?></td>
                            <td><?php echo e($item->deskripsi); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.produk.edit', $item->id)); ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                                <form action="<?php echo e(route('admin.produk.destroy', $item->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus produk ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger mb-1">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada produk.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <?php echo e($produk->links()); ?>

            </div>
        </div>
    </div>
</div>

<!-- AJAX Search Script -->
<script>
document.getElementById('search').addEventListener('keyup', function() {
    let query = this.value.toLowerCase();
    let rows = document.querySelectorAll('#produkList tr');

    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir\resources\views/admin/produk/index.blade.php ENDPATH**/ ?>