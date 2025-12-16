@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex">

    <!-- KONTEN UTAMA -->
    <div class="flex-grow-1 ms-4">
        <h3 class="mb-4">Kelola Kategori</h3>

        <!-- Form Tambah Kategori -->
        <div class="card mb-4">
            <div class="card-header">Tambah Kategori Baru</div>
            <div class="card-body">
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                </form>
            </div>
        </div>

        <!-- Tabel Kategori -->
        <div class="card">
            <div class="card-header">Daftar Kategori</div>
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $index => $item)
                        <tr>
                            <td>{{ $kategori->firstItem() + $index }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <a href="{{ route('admin.kategori.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                {{ $kategori->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
