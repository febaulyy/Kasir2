@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">Edit Kategori</h3>

    <div class="card">
        <div class="card-header">Form Edit Kategori</div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $kategori->nama) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>
@endsection
