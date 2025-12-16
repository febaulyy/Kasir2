@extends('layouts.user')

@section('title', 'Riwayat Pesanan')

@section('content')

<style>
    body {
        background:#f4f1ec !important; /* krem coffee */
    }

    .history-card {
        border-radius:16px;
        background:#ffffff;
        box-shadow:0 6px 18px rgba(0,0,0,.08);
        border:1px solid #e5dccd;
    }

    .status-badge {
        color:#4a2c2a;
        font-weight:600;
        background:#efe6d8;
        border-radius:8px;
    }

    .btn-coffee {
        border-color:#4a2c2a;
        color:#4a2c2a;
        border-radius:10px;
    }

    .btn-coffee:hover {
        background:#4a2c2a;
        color:#fff;
    }
</style>

<div class="container py-4" style="max-width: 800px;">

    <h2 class="mb-4 fw-bold" style="color:#2e1b19;">
        Riwayat Pesanan
    </h2>

    @if ($orders->isEmpty())
        <div class="alert alert-info text-center rounded-4">
            Belum ada pesanan.
        </div>
    @else
        @foreach ($orders as $order)

            @php
                $firstItem = $order->details->first();
            @endphp

            <div class="card mb-3 history-card">
                <div class="card-body">

                    {{-- HEADER --}}
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div></div>
                        <span class="px-3 py-1 small status-badge">
                            Selesai
                        </span>
                    </div>

                    {{-- PRODUK --}}
                    @if ($firstItem)

                        @php
                            $foto = $firstItem->foto_produk 
                                    ? 'storage/'.$firstItem->foto_produk
                                    : ($firstItem->produk 
                                        ? 'storage/'.$firstItem->produk->foto
                                        : 'https://via.placeholder.com/80');
                        @endphp

                        <div class="d-flex gap-3 mt-n2">

                            {{-- FOTO --}}
                            <img src="{{ asset($foto) }}"
                                class="rounded"
                                style="width:80px;height:80px;object-fit:cover;border:1px solid #d6c8b5;">

                            <div class="flex-grow-1">

                                <div class="fw-semibold"
                                     style="font-size:0.95rem;color:#2e1b19;margin-top:2px;">
                                    {{ $firstItem->nama_produk ?? ($firstItem->produk->nama ?? 'Produk') }}
                                </div>

                                <div class="text-muted small mt-1">
                                    Rp {{ number_format($firstItem->harga_satuan, 0, ',', '.') }}
                                    × {{ $firstItem->qty }}
                                </div>

                                @if ($order->details->count() > 1)
                                    <div class="text-muted small">
                                        +{{ $order->details->count() - 1 }} produk lainnya
                                    </div>
                                @endif

                                <div class="text-muted small mt-1">
                                    {{ $order->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                                </div>

                            </div>
                        </div>
                    @endif

                    <hr style="border-color:#e5dccd;">

                    {{-- TOTAL --}}
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="fw-bold" style="font-size:0.95rem;color:#2e1b19;">
                            Total Harga:
                            <span style="color:#4a2c2a;">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('user.struk', $order->id) }}"
                           class="btn btn-sm btn-coffee">
                            Cetak Struk
                        </a>

                    </div>

                </div>
            </div>

        @endforeach
    @endif

</div>
@endsection
