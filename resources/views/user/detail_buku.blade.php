@extends('layouts.backend.usertemp')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>{{ $buku->judul }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('images/buku/' . $buku->image) }}" alt="Foto Buku"
                                        class="img-thumbnail mb-3"
                                        style="width: 180px; height: 210px; object-fit: cover; margin-top:20px;">
                </div>
                <div class="col-md-8">
                    <p><strong>Penulis:</strong> {{ $buku->penulis->nama_penulis }}</p>
                    <p><strong>Penerbit:</strong> {{ $buku->penerbit->nama_penerbit }}</p>
                    <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
                    <p><strong>Deskripsi:</strong></p>
                    <p>{{ $buku->deskripsi }}</p>
                    <a href="{{ route('buku') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
