@extends('layouts.app')

@section('title', $buku->judul . ' - Detail Buku')

@section('content')
    <h1>{{ $buku->judul }}</h1>
    <img src="{{ asset('gambar/' . $buku->gambar) }}" alt="{{ $buku->judul }}" style="width:200px;">
    <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($buku->harga, 0, ',', '.') }}</p>
    <p><strong>Deskripsi:</strong><br> {!! nl2br(e($buku->deskripsi)) !!}</p>
@endsection
