<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembelian</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 8px;
        }

        .center {
            text-align: center;
        }

        .line {
            border-bottom: 1px dashed #000;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 4px 0;
            vertical-align: top;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
        }

        .small {
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="title">STRUK PEMBELIAN</div>

    <div class="small">
        <strong>ID Pesanan:</strong> #<?php echo e($order->id); ?><br>
        <strong>Tanggal:</strong>
        <?php echo e($order->created_at->timezone('Asia/Jakarta')->format('d M Y H:i')); ?> WIB<br>
        <strong>Pembayaran:</strong> <?php echo e($order->metode_pembayaran); ?>

    </div>

    <div class="line"></div>

    <table>
        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <?php echo e($item->nama_produk); ?>

                    <br>
                    <small>
                        Rp <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?>

                        × <?php echo e($item->qty); ?>

                    </small>
                </td>
                <td class="right">
                    Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?>

                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td class="bold">Total</td>
            <td class="right total">
                Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?>

            </td>
        </tr>

        <?php if($order->metode_pembayaran === 'Cash'): ?>
            <tr>
                <td>Uang Dibayar</td>
                <td class="right">
                    Rp <?php echo e(number_format($order->uang_dibayar, 0, ',', '.')); ?>

                </td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td class="right">
                    Rp <?php echo e(number_format($order->kembalian, 0, ',', '.')); ?>

                </td>
            </tr>
        <?php endif; ?>

    </table>

    <div class="line"></div>

    <p class="center small">
        Terima kasih telah berbelanja 🙏<br>
        Barang yang sudah dibeli tidak dapat dikembalikan
    </p>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/user/struk.blade.php ENDPATH**/ ?>