@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h1><strong>Daftar Produk</strong></h1>
                    </div>

                    <div class="card-body">
                        <div class="tambah">
                            <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</a>
                        </div>
                        <table class="table table-bordered p-3 text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID Produk</th>
                                    <th>Foto</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Kuantitas</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $key)
                                    <tr>
                                        <td>{{ $key->id }}</td>
                                        <td><img src="{{ asset('storage/' . $key->foto) }}" alt=""
                                                style="width: 150px"></td>
                                        <td>{{ $key->nama_produk }}</td>
                                        <td>Rp. {{ number_format($key->harga,0,",",".") }}</td>
                                        <td>
                                            <details>
                                                <summary>Deskripsi</summary>
                                                {{ $key->desc_produk }}
                                            </details>
                                        </td>
                                        <td>{{ $key->kuantitas }}</td>
                                        <td>{{ $key->kategori->nama_kategori }}</td>
                                        <td>
                                            <form action="{{ route('produk.destroy', $key->id) }}" class="d-flex flex-column" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#ed{{ $key->id }}">Edit</a>
                                                <button type="submit" class="btn btn-danger mt-1" onclick="return confirm('Apakah Anda Yakin?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="ed{{ $key->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Produk</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('produk.update', $key->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" name="nama_produk" class="form-control"
                                                                value="{{ $key->nama_produk }}" required>
                                                            <label for="formFloatingInput">Nama Produk</label>
                                                        </div>
                                                        <div class="mb-3 form-floating text-center">
                                                            <img src="{{ asset('storage/' . $key->foto) }}" alt=""
                                                                style="width: 100px">
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="file" name="foto" class="form-control"
                                                                value="{{ $key->foto }}">
                                                            <label for="formFloatingInput">Foto</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="number" name="harga" class="form-control"
                                                                value="{{ $key->harga }}" required>
                                                            <label for="formFloatingInput">Harga</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <textarea class="form-control" name="desc_produk" id="exampleFormControlTextarea1" rows="3">{{ $key->desc_produk }}</textarea>
                                                            <label for="exampleFormControlTextarea1"
                                                                class="form-label">Deskripsi</label>
                                                        </div>
                                                        @if (Auth::user()->role == 'admin')
                                                            <div class="mb-3 form-floating">
                                                                <input type="number" name="kuantitas" class="form-control"
                                                                    value="{{ $key->kuantitas }}">
                                                                <label for="formFloatingInput">Kuantitas</label>
                                                            </div>
                                                        @else
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" name="nama_produk" class="form-control" required>
                        <label for="formFloatingInput">Nama Produk</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="file" name="foto" class="form-control" required>
                        <label for="formFloatingInput">Foto</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="number" name="harga" class="form-control" required>
                        <label for="formFloatingInput">Harga</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" name="desc_produk" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                    </div>
                    @if (Auth::user()->role == 'admin')
                        <div class="mb-3 form-floating">
                            <input type="number" name="kuantitas" class="form-control">
                            <label for="formFloatingInput">Kuantitas</label>
                        </div>
                    @else
                    @endif
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
