@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card ">
                        <div class="card-body">
                            <h1 class="card-title text-center"><strong>{{ $post->judul }}</strong></h1>
                            <p class="card-text text-center">ditulis oleh: {{ $post->user->name }},
                                {{ $post->tanggalDibuat }}</p>
                            <p class="card-text mt-4">{{ $post->isi }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="mt-5">Rekomendasi Produk</h2>
            <div class="col-md-10">
                <div class="row">
                    @foreach($produk as $produk)
                    @if($produk->kuantitas != 0)                       
                    <div class="col-2 text-center">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('storage/' . $produk->foto) }}" alt="" class="card-img-top" >
                            <div class="card-body">
                                <p class="card-text"><strong>{{ $produk->nama_produk }}</strong></p>
                                <p class="card-text">Rp. {{ number_format($produk->harga,0,",",".") }}</p>
                            </div>
                        </div>
                    </div>
                    @endif                       
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
