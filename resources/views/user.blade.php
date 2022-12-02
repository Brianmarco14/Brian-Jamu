@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h1><strong>Daftar User</strong></h1>
                    </div>

                    <div class="card-body">
                        <div class="tambah">
                            <a href="" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#tambah">Tambah</a>
                        </div>
                        <table class="table table-bordered p-3 text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID user</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key)
                                    <tr>
                                        <td>{{ $key->id }}</td>
                                        <td>{{ $key->name }}</td>
                                        <td>{{ $key->email }}</td>
                                        <td>{{ $key->role }}</td>
                                        <td>
                                            <form action="{{ route('user.destroy', $key->id) }}" method="POST">
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
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit user</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('user.update', $key->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" name="name" class="form-control" value="{{ $key->name }}" required>
                                                            <label for="formFloatingInput">Nama</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="email" name="email" class="form-control" value="{{ $key->email }}" required>
                                                            <label for="formFloatingInput">Email</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="password" name="password" class="form-control">
                                                            <label for="formFloatingInput">Password</label>
                                                        </div>
                                                        
                                                        <div class="mb-3 form-floating">
                                                            <select class="form-select" name="role" aria-label="Default select example">
                                                                <option value="{{ $key->role }}" selected disabled>
                                                                    {{ $key->role }}
                                                                </option>
                                                                <option value="user">User</option>
                                                                <option value="editor">Editor</option>
                                                                <option value="admin">Admin</option>
                                                              </select>
                                                            <label for="formFloatingSelect">Role</label>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" name="name" class="form-control" required>
                        <label for="formFloatingInput">Nama</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="email" name="email" class="form-control" required>
                        <label for="formFloatingInput">Email</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="password" name="password" class="form-control" required>
                        <label for="formFloatingInput">Password</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <select class="form-select" name="role" aria-label="Default select example">
                            <option value="" selected disabled>Pilih Role</option>
                            <option value="user">User</option>
                            <option value="editor">Editor</option>
                            <option value="admin">Admin</option>
                          </select>
                        <label for="formFloatingSelect">Role</label>
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
