@extends('layouts.user')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container py-4" style="max-width: 800px;">

    <h2 class="mb-4 fw-bold">Riwayat Pesanan</h2>

    @if ($orders->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada pesanan.
        </div>
    @else
        @foreach ($orders as $order)

            @php
                $firstItem = $order->details->first();
            @endphp

            <div class="card mb-3 shadow-sm border-0" 
                style="border-radius:14px; background:#fff;">
                <div class="card-body">

                    {{-- HEADER TANPA ORDER ID --}}
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div></div> {{-- Kosong agar status tetap kanan --}}
                        <span class="px-2 py-1 small"
                            style="color:#ff5f00; font-weight:600;">
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

                            {{-- FOTO PRODUK --}}
                            <img src="{{ asset($foto) }}"
                                class="rounded"
                                style="width: 80px; height: 80px; object-fit: cover;">

                            <div class="flex-grow-1">

                                {{-- NAMA PRODUK --}}
                                <div class="fw-semibold" style="font-size: 0.95rem; margin-top:2px;">
                                    {{ $firstItem->nama_produk ?? ($firstItem->produk->nama ?? 'Produk') }}
                                </div>

                                {{-- HARGA × QTY --}}
                                <div class="text-muted small mt-1">
                                    Rp {{ number_format($firstItem->harga_satuan, 0, ',', '.') }}
                                    × {{ $firstItem->qty }}
                                </div>

                                {{-- PRODUK LAINNYA --}}
                                @if ($order->details->count() > 1)
                                    <div class="text-muted small">
                                        +{{ $order->details->count() - 1 }} produk lainnya
                                    </div>
                                @endif

                                {{-- TANGGAL (WIB) --}}
                                <div class="text-muted small mt-1">
                                    {{ $order->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                                </div>

                            </div>

                        </div>
                    @endif

                    <hr>

                    {{-- TOTAL + CETAK STRUK --}}
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="fw-bold" style="font-size:0.95rem;">
                            Total Harga:
                            <span class="text-danger">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('user.struk', $order->id) }}"
                            class="btn btn-sm btn-outline-primary"
                            style="border-radius:8px;">
                            Cetak Struk
                        </a>

                    </div>

                </div>
            </div>

        @endforeach
    @endif

</div>
@endsection
