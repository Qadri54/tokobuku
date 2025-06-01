@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<h2>Edit Buku</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.books.update', $book->id_buku) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $book->judul) }}" required>
    </div>

    <div class="mb-3">
        <label for="penulis" class="form-label">Penulis</label>
        <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis', $book->penulis) }}" required>
    </div>

    <div class="mb-3">
        <label for="penerbit" class="form-label">Penerbit</label>
        <input type="text" name="penerbit" id="penerbit" class="form-control" value="{{ old('penerbit', $book->penerbit) }}" required>
    </div>

    <div class="mb-3">
        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" required>
    </div>

    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $book->harga) }}" required>
    </div>

    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', $book->stok) }}" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $book->deskripsi) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar (kosongkan jika tidak ingin ganti)</label>
        <input type="file" name="gambar" id="gambar" class="form-control">
        @if($book->gambar && file_exists(public_path('gambar/' . $book->gambar)))
            <img src="{{ asset('gambar/' . $book->gambar) }}" alt="gambar buku" width="100" class="mt-2">
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update Buku</button>
    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection
