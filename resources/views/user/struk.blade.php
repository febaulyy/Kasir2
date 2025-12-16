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
        <strong>ID Pesanan:</strong> #{{ $order->id }}<br>
        <strong>Tanggal:</strong>
        {{ $order->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB<br>
        <strong>Pembayaran:</strong> {{ $order->metode_pembayaran }}
    </div>

    <div class="line"></div>

    <table>
        @foreach ($order->details as $item)
            <tr>
                <td>
                    {{ $item->nama_produk }}
                    <br>
                    <small>
                        Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                        × {{ $item->qty }}
                    </small>
                </td>
                <td class="right">
                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td class="bold">Total</td>
            <td class="right total">
                Rp {{ number_format($order->total, 0, ',', '.') }}
            </td>
        </tr>

        @if($order->metode_pembayaran === 'Cash')
            <tr>
                <td>Uang Dibayar</td>
                <td class="right">
                    Rp {{ number_format($order->uang_dibayar, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td class="right">
                    Rp {{ number_format($order->kembalian, 0, ',', '.') }}
                </td>
            </tr>
        @endif

    </table>

    <div class="line"></div>

    <p class="center small">
        Terima kasih telah berbelanja 🙏<br>
        Barang yang sudah dibeli tidak dapat dikembalikan
    </p>

</body>
</html>
