<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .line {
            border-bottom: 1px dashed #000;
            margin: 10px 0;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        table td {
            padding: 4px 0;
        }

        .right {
            text-align: right;
        }

        .total {
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="title">Struk Pembelian</div>

    <div>
        <strong>ID Pesanan:</strong> #<?php echo e($order->id); ?> <br>
        <strong>Tanggal:</strong> <?php echo e($order->created_at->timezone('Asia/Jakarta')->format('d M Y H:i')); ?> WIB
    </div>

    <div class="line"></div>

    <table>
        <?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <?php echo e($item->nama_produk ?? ($item->produk->nama ?? 'Produk')); ?> <br>
                    <small>Rp <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?> × <?php echo e($item->qty); ?></small>
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
            <td class="total">Total</td>
            <td class="right total">
                Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?>

            </td>
        </tr>
    </table>

    <div class="line"></div>

    <p style="text-align:center;">Terima kasih telah berbelanja!</p>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Kasir\resources\views/user/struk.blade.php ENDPATH**/ ?>