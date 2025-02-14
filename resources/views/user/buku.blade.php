@extends('layouts.backend.usertemp')
@section('content')
    <!-- Class Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <h1 class="mb-4 mt-5">WELCOME TO THE BOOK PAGE</h1>
            </div>
            <div class="row">
                <ul class="tabs">
                    {{-- @foreach ($kategori as $item)
                            <li class="tab">
                                <a href="{{ route('kategori.filter', $item->id) }}#popular-books">{{ $item->nama_kategori }}</a>
                            </li>
                        @endforeach --}}
                    {{-- <li data-tab-target="#all-genre" class="active tab">All Genre</li>
                        <li data-tab-target="#business" >Business</li>
                        <li data-tab-target="#technology" class="tab">Tec   hnology</li>
                        <li data-tab-target="#romantic" class="tab">Romantic</li>
                        <li data-tab-target="#adventure" class="tab">Adventure</li>
                        <li data-tab-target="#fictional" class="tab">Fictional</li> --}}
                </ul>
                @foreach ($buku as $hideng)
                    <div class="col-md-3">
                        <div class="product-item">
                            <figure class="product-style">
                                <img src="{{ asset('images/buku/' . $hideng->image) }}" alt="Books"
                                    onerror="this.onerror=null; this.src='{{ asset('User/assets/images/available.png') }}';"
                                    class="product-item" style="width: 180px; height: 210px; object-fit: ">
                                <button type="button" class="add-to-cart" data-product-tile="add-to-cart"><a
                                        href="{{ route('peminjaman.create') }}">Want to borrow?</a></button>
                            </figure>
                            <figcaption>
                                <h3>{{ $hideng->judul }}</h3>
                                <p>
                                    Status:
                                    <span class="badge {{ $hideng->jumlah_buku > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $hideng->jumlah_buku > 0 ? 'Available' : 'Empty' }}
                                    </span>
                                    <a href="{{ route('detail.buku', $hideng->id) }}" class="btn btn-success">Lihat
                                        Detail</a>
                                </p>
                            </figcaption>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Class End -->
@endsection
