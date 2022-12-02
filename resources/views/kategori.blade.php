@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h1><strong>Daftar Kategori</strong></h1>
                    </div>

                    <div class="card-body">
                        <div class="tambah">
                            <a href="" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#tambah">Tambah</a>
                        </div>
                        <table class="table table-bordered p-3 text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID kategori</th>
                                    <th>Nama kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $key)
                                    <tr>
                                        <td>{{ $key->id }}</td>
                                        <td>{{ $key->nama_kategori }}</td>
                                        <td>
                                            <details>
                                                <summary>Deskripsi</summary>
                                                {{ $key->desc_kategori }}
                                            </details>
                                        </td>
                                        <td>
                                            <form action="{{ route('kategori.destroy', $key->id) }}" method="POST">
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
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('kategori.update', $key->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" name="nama_kategori" class="form-control"
                                                                value="{{ $key->nama_kategori }}" required>
                                                            <label for="formFloatingInput">Nama kategori</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <textarea class="form-control" name="desc_kategori" id="exampleFormControlTextarea1" rows="3">{{ $key->desc_kategori }}</textarea>
                                                            <label for="exampleFormControlTextarea1"
                                                                class="form-label">Deskripsi</label>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Edit</button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" name="nama_kategori" class="form-control" required>
                        <label for="formFloatingInput">Nama kategori</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" name="desc_kategori" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
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
