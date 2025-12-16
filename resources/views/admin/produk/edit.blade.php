@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex flex-wrap">

    <!-- KONTEN UTAMA -->
    <div class="flex-grow-1">
        <h3 class="mb-4">Edit Produk</h3>

        <div class="card">
            <div class="card-header">Form Edit Produk</div>
            <div class="card-body">
                <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Nama Produk</label>
                            <input type="text" name="nama" class="form-control"
                                   value="{{ old('nama', $produk->nama) }}" required>
                        </div>

                        <div class="col-md-3">
                            <label>Harga</label>
                            <input type="number" name="harga" class="form-control"
                                   value="{{ old('harga', $produk->harga) }}" required>
                        </div>

                        <div class="col-md-3">
                            <label>Stok</label>
                            <input type="number" name="stock" class="form-control"
                                   value="{{ old('stock', $produk->stock) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}"
                                        {{ (string) old('kategori_id', $produk->kategori_id) === (string) $k->id ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control">
                            @if($produk->foto)
                                <img src="{{ asset('storage/'.$produk->foto) }}" alt="Foto Produk" width="100" class="mt-2 rounded">
                            @endif
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
@endsection
