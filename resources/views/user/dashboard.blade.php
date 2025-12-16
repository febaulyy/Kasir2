@extends('layouts.user')

@section('content')

<style>
    body {
        background: #f2f2f7 !important;
    }
    
    .btn-produk {
        background-color: #333 !important;
        border-color: #333 !important;
    }

    .btn-produk:hover {
        background-color: #555 !important;
        border-color: #555 !important;
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-title {
        font-weight: 600;
        color: #222;
    }

    .card-text {
        color: #555;
    }

    #search, #filterKategori {
        border-radius: 10px;
        border: 1px solid #ccc;
    }

    #produkList .card-img-top {
        background: #eee;
    }

    /* Blur jika stok habis */
    .img-blur {
        filter: grayscale(80%) brightness(70%);
    }
</style>

<div class="container my-4">

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

    <!-- Search Produk -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="search" class="form-control" placeholder="Cari produk...">
        </div>

        <div class="col-md-4">
            <select id="filterKategori" class="form-select">
                <option value="">-- Semua Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row" id="produkList">
        @forelse($produk as $item)
        <div class="col-md-4 mb-4 produk-item" data-kategori="{{ $item->kategori_id }}">
            <div class="card h-100 shadow-sm position-relative">
                
                @if($item->foto)
                    <img 
                        src="{{ asset('storage/'.$item->foto) }}" 
                        class="card-img-top {{ $item->stock <= 0 ? 'img-blur' : '' }}"
                        style="height:180px; object-fit:cover;">
                @endif

                {{-- BADGE STOK HABIS --}}
                @if($item->stock <= 0)
                <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1 rounded-bottom-end fw-bold">
                    Habis
                </div>
                @endif
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->nama }}</h5>
                    <p class="card-text mb-1">Rp {{ number_format($item->harga,0,',','.') }}</p>

                    {{-- STATUS STOK --}}
                    @if($item->stock <= 0)
                        <p class="card-text text-danger fw-bold mb-2 d-none">Stok: Habis</p>
                    @else 
                        <p class="card-text text-success fw-semibold mb-2 d-none">Stok: {{ $item->stock }}</p>
                    @endif

                    <p class="card-text flex-grow-1 d-none">{{ $item->deskripsi }}</p>

                    <div class="mt-auto">

                        {{-- KALO STOK ADA --}}
                        @if($item->stock > 0)
                            <div class="d-flex gap-2">

                                {{-- Tambah ke Keranjang --}}
                                <form action="{{ route('user.cart.add', $item->id) }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    <button type="submit" class="btn btn-dark w-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-shopping-cart me-2"></i> Tambahkan ke Keranjang
                                    </button>
                                </form>

                                {{-- Beli Sekarang (optional aktifkan bila mau) --}}
                                <form action="{{ route('user.checkout.now', $item->id) }}" method="POST" class="flex-grow-1 d-none">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-bolt me-2"></i> Beli
                                    </button>
                                </form>

                            </div>

                        {{-- KALO STOK HABIS --}}
                        @else
                            <button class="btn btn-secondary w-100" disabled>
                                Tidak Tersedia
                            </button>
                        @endif

                    </div>

                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-center">Belum ada produk tersedia.</p>
        </div>
        @endforelse
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById('search');
    searchInput.addEventListener('keyup', function() {
        let query = this.value.toLowerCase();
        document.querySelectorAll('.produk-item').forEach(item => {
            let text = item.textContent.toLowerCase();
            item.style.display = text.includes(query) ? '' : 'none';
        });
    });

    const filterSelect = document.getElementById('filterKategori');
    filterSelect.addEventListener('change', function() {
        let kategori = this.value.trim();
        
        document.querySelectorAll('.produk-item').forEach(item => {
            let itemKategori = item.dataset.kategori;

            if (kategori === "" || itemKategori === kategori) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    });

});
</script>

@endsection
