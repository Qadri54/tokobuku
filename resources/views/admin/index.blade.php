@extends('layouts.app')

@section('title', 'Kelola Buku')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Kelola Buku</h2>
        <div>
            <a href="{{ route('admin.books.create') }}" class="btn btn-success">+ Tambah Buku</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Buku -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle" id="myTable">
            <thead class="table-primary">
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td>{{ $book->judul }}</td>
                        <td>{{ $book->penulis }}</td>
                        <td>{{ $book->penerbit }}</td>
                        <td>{{ $book->tahun_terbit }}</td>
                        <td>Rp {{ number_format($book->harga, 0, ',', '.') }}</td>
                        <td>{{ $book->stok }}</td>
                        <td>
                            @if($book->gambar && file_exists(public_path('storage/gambar/' . $book->gambar)))
                                <img src="{{ asset('storage/gambar/' . $book->gambar) }}" alt="gambar buku" width="60">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.books.edit', $book->id_buku) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book->id_buku) }}" method="POST"
                                style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Tidak ada data buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection