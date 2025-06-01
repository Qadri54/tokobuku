@extends('layouts.app')

@section('title', 'Tambah Buku Baru')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Buku Baru</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada beberapa masalah dengan input Anda:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis') }}" required>
            </div>

            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" class="form-control" value="{{ old('penerbit') }}"
                    required>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control"
                        value="{{ old('tahun_terbit') }}" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" required
                        step="0.01">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Buku</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Buku</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
@endsection