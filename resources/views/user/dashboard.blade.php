@extends('layouts.user')

@section('content')

<style>
body {
    background: #f4f1ec !important;
    font-family: 'Poppins', sans-serif;
}

/* WRAPPER */
.page {
    max-width: 1200px;
    margin: auto;
    padding: 2rem 1rem;
}

/* HEADER */
.header {
    background: #48252F;
    color: #E7D4BB;
    padding: 1.5rem 2rem;
    border-radius: 16px;
    margin-bottom: 1.5rem;
}

/* FILTER BAR */
.filter-bar {
    background: #fff;
    border-radius: 16px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: 1px solid #d1c7b8;
    display: flex;
    gap: 1rem;
}

/* INPUT */
.search-input, .filter-select {
    border-radius: 14px;
    border: 1px solid #d1c7b8;
    padding: 10px 14px;
    background: #f9f7f3;
}

/* LIST */
.product-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* ROW CARD */
.product-row {
    display: flex;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
}

/* IMAGE */
.product-row img {
    width: 160px;
    height: 140px;
    object-fit: cover;
}

/* CONTENT */
.product-content {
    flex: 1;
    padding: 1rem 1.2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* LEFT INFO */
.product-info h6 {
    margin: 0;
    font-weight: 600;
}

.product-info span {
    color: #48252F;
    font-weight: 700;
}

/* BUTTON */
.btn-coffee {
    background: #48252F;
    color: #E7D4BB;
    border-radius: 12px;
    font-weight: 600;
}

.btn-disabled {
    background: #e0e0e0;
    color: #777;
    border-radius: 12px;
}
</style>

<div class="page">

    <div class="header">
        <h4>Selamat Datang</h4>
        <small>Nikmati kopi terbaik bersama {{ Auth::user()->name }}</small>
    </div>

    <div class="filter-bar">
        <input type="text" id="search" class="form-control search-input" placeholder="Cari produk...">
        <select id="filterKategori" class="form-select filter-select">
            <option value="">Semua Kategori</option>
            @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="product-list">
        @foreach($produk as $item)
        <div class="produk-item product-row" data-kategori="{{ $item->kategori_id }}">

            @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}">
            @endif

            <div class="product-content">
                <div class="product-info">
                    <h6>{{ $item->nama }}</h6>
                    <small>{{ $item->kategori->nama }}</small><br>
                    <span>Rp {{ number_format($item->harga,0,',','.') }}</span><br>

                    @if($item->stock <= 0)
                        <small class="text-danger">Stok Habis</small>
                    @else
                        <small class="text-success">Stok: {{ $item->stock }}</small>
                    @endif
                </div>

                <div>
                    @if($item->stock > 0)
                        <form action="{{ route('user.cart.add', $item->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-coffee">
                                +
                            </button>
                        </form>
                    @else
                        <button class="btn btn-disabled" disabled>
                            Tidak Tersedia
                        </button>
                    @endif
                </div>
            </div>

        </div>
        @endforeach
    </div>

</div>

<script>
document.getElementById('search').addEventListener('keyup', function() {
    let q = this.value.toLowerCase();
    document.querySelectorAll('.produk-item').forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});

document.getElementById('filterKategori').addEventListener('change', function() {
    let k = this.value;
    document.querySelectorAll('.produk-item').forEach(item => {
        item.style.display = (k === "" || item.dataset.kategori === k) ? "" : "none";
    });
});
</script>

@endsection
