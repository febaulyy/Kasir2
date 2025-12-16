@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Pesanan Masuk</h2>

    {{-- FILTER TANGGAL --}}
    <form method="GET" class="d-flex gap-3 mb-4">
        <select name="filter" class="form-select" style="max-width: 200px;">
            <option value="">Semua</option>
            <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Hari Ini</option>
            <option value="yesterday" {{ request('filter') == 'yesterday' ? 'selected' : '' }}>Kemarin</option>
            <option value="date" {{ request('filter') == 'date' ? 'selected' : '' }}>Pilih Tanggal</option>
        </select>

        <input type="date" name="date" 
               value="{{ request('date') }}" 
               class="form-control"
               style="max-width: 200px;">

        <button class="btn btn-primary">Filter</button>
    </form>

    {{-- DATA KOSONG --}}
    @if($orders->isEmpty())
        <div class="alert alert-info text-center">Tidak ada pesanan ditemukan.</div>
    @else

        @foreach ($orders as $order)
            <div class="card mb-3 shadow-sm border-0" style="border-radius: 14px;">
                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <div class="fw-semibold">User: {{ $order->user->name }}</div>
                        <div class="text-muted small">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </div>
                    </div>

                    <hr>

                    @foreach ($order->details as $detail)
                        <div class="d-flex justify-content-between mb-2 small">
                            <div>
                                {{ optional($detail->produk)->nama ?? 'Produk sudah dihapus' }}
                                (ID: {{ $detail->produk_id }})
                                ({{ $detail->qty }} × Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }})
                            </div>
                            <div>
                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between">
                        <div class="fw-bold">
                            Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                        </div>
                        <div class="text-muted small">
                            Metode: {{ $order->metode_pembayaran ?? 'Tidak ada' }}
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

    @endif

</div>

{{-- SCRIPT AGAR FILTER DAN TANGGAL TIDAK AKTIF BERSAMAAN --}}
<script>
    const filterSelect = document.querySelector('select[name="filter"]');
    const dateInput = document.querySelector('input[name="date"]');

    function updateDateState() {
        if (filterSelect.value === 'date') {
            dateInput.disabled = false;
            dateInput.style.background = '#fff';
        } else {
            dateInput.disabled = true;
            dateInput.value = '';
            dateInput.style.background = '#e9ecef';
        }
    }

    filterSelect.addEventListener('change', updateDateState);

    updateDateState();
</script>

@endsection
