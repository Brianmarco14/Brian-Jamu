@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h1><strong>Daftar Postingan</strong></h1>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($post as $key)
                            @if($key->status == "aktif")
                            <div class="col-3 me-5">
                                <div class="card p-3" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ asset('storage/' . $key->foto) }}" alt=""
                                    style="width: 150px">
                                    <div class="card-body">
                                      <h5 class="card-title"><strong>{{ $key->judul }}</strong></h5>
                                      <p class="card-text">{{ $key->isi }}</p>
                                      <a href="{{ url('detail/'.$key->id) }}" class="btn btn-primary">Lihat selengkapnya...</a>
                                    </div>
                                  </div>
                            </div>                             
                            @endif                               
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection