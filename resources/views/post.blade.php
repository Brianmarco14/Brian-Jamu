@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h1><strong>Daftar Postingan</strong></h1>
                    </div>

                    <div class="card-body">
                        <div class="tambah">
                            <a href="" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#tambah">Tambah</a>
                        </div>
                        <table class="table table-bordered p-3 text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID post</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Penulis</th>
                                    @if (Auth::user()->role == 'admin')
                                        <th>Status</th>
                                    @endif

                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $key)
                                    <tr>
                                        <td>{{ $key->id }}</td>
                                        <td><h4 class="text-uppercase"><strong >{{ $key->judul }}</strong></h4></td>
                                        <td>
                                            <details>
                                                <summary>Isi</summary>
                                                {{ $key->isi }}
                                            </details>
                                        </td>
                                        <td>{{ $key->tanggalDibuat }}</td>
                                        <td>{{ $key->user->name }}</td>
                                        @if (Auth::user()->role == 'admin')
                                        @if($key->status == "aktif")
                                            
                                        <td><p class="bg-success rounded text-light">Aktif</p></td>
                                        @else
                                        <td><p class="bg-danger rounded text-light">Tidak Aktif</p></td>
                                            
                                        @endif
                                    @endif
                                        <td>
                                            <form action="{{ route('post.destroy', $key->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#ed{{ $key->id }}">Edit</a>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="ed{{ $key->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit post</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('post.update', $key->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" name="judul" class="form-control"  value="{{ $key->judul }}" required>
                                                            <label for="formFloatingInput">Judul</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <textarea class="form-control" name="isi" id="exampleFormControlTextarea1" rows="3">{{ $key->isi }}</textarea>
                                                            <label for="exampleFormControlTextarea1" class="form-label">Isi</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="date" name="tanggalDibuat" class="form-control" value="{{ $key->tanggalDibuat }}" required>
                                                            <label for="formFloatingInput">Tanggal Dibuat</label>
                                                        </div>
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        @if (Auth::user()->role == 'admin')
                                                            <div class="mb-3 form-floating">
                                                                <select class="form-select" name="status" aria-label="Default select example">
                                                                    <option value="{{ $key->status }}" {{ $key->status == $key->status ? 'selected' : '' }}>
                                                                        {{ $key->status }}
                                                                    </option>
                                                                    <option value="aktif">Aktif</option>
                                                                    <option value="tidak aktif">Tidak Aktif</option>
                                                                </select>
                                                                <label for="formFloatingSelect">Status</label>
                                                            </div>
                                                        @endif
                                                        <div class="my-3 form-floating">
                                                            <select name="kategori_id" class="form-select">
                                                            <option selected disabled>Pilih Kategori</option>
                                                            @foreach ($kategori as $item)
                                                                <option value="{{ $item->id }}" {{ $item->id == $key->kategori_id ? 'selected' : '' }}>
                                                                    {{ $item->nama_kategori }}
                                                                </option>
                                                            @endforeach            
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Postingan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" name="judul" class="form-control" required>
                        <label for="formFloatingInput">Judul</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" name="isi" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <label for="exampleFormControlTextarea1" class="form-label">Isi</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="date" name="tanggalDibuat" class="form-control" required>
                        <label for="formFloatingInput">Tanggal Dibuat</label>
                    </div>
                    @if (Auth::user()->role == 'admin')
                        <div class="mb-3 form-floating">
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option selected>Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                            <label for="formFloatingSelect">Status</label>
                        </div>
                    @endif
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="my-3 form-floating">
                        <select name="kategori_id" class="form-select">
                            <option selected disabled>Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" @selected(old('kategori_id') == $item->id)>
                                    {{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
