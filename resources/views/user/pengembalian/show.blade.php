@extends('layouts.backend.usertemp')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Detail Pengembalian Buku</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label"><strong>Judul Buku:</strong></label>
                <p>{{ $pengembalian->peminjaman->buku->judul }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Nama Peminjam:</strong></label>
                <p>{{ $pengembalian->peminjaman->nama }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Jumlah Buku yang Dipinjam:</strong></label>
                <p>{{ $pengembalian->peminjaman->jumlah }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Tanggal Peminjaman:</strong></label>
                <p>{{ $pengembalian->peminjaman->tgl_pinjam }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Tanggal Pengembalian:</strong></label>
                <p>{{ $pengembalian->tgl_kembali }}</p>
            </div>
            <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary">Kembali ke Daftar Pengembalian</a>
        </div>
    </div>
@endsection
