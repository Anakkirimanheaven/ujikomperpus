@extends('layouts.backend.usertemp')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit data peminjaman</h4>

            <form class="row g-3" method="POST" action="{{ route('peminjaman.update', $peminjaman->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <!-- Pilihan Buku -->
                <div class="col-md-12 mb-3">
                    <label for="id_buku" class="form-label">Title Book</label>
                    <select name="id_buku" id="id_buku" class="form-control">
                        @foreach ($buku as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $peminjaman->id_buku ? 'selected' : '' }}>
                                {{ $data->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah Buku -->
                <div class="col-md-12 mb-3">
                    <label for="jumlah" class="form-label">Amount Book</label>
                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                        placeholder="Jumlah" value="{{ old('jumlah', $peminjaman->jumlah) }}" required>
                    @error('jumlah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Nama Peminjam -->
                <div class="col-md-12 mb-3">
                    <label for="nama" class="form-label">Borrower Name</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        placeholder="Nama Peminjam" value="{{ old('nama', $peminjaman->nama) }}" required>
                    @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Tanggal Pengembalian -->
                <div class="col-md-12 mb-3">
                    <label for="tgl_kembali" class="form-label">Return Date</label>
                    <input type="date" name="tgl_kembali" class="form-control @error('tglkembalip') is-invalid @enderror"
                        value="{{ old('tgl_kembali', $peminjaman->tgl_kembali) }}" required>
                    @error('tgl_kembali')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Status Peminjaman -->
                <div class="col-md-12 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="dikembalikan">Dikembalikan</option>
                    </select>
                </div>

                <!-- Tombol Submit dan Cancel -->
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
