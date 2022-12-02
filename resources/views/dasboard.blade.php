@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h1><strong>Rekomendasi Jamu</strong></h1>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="card p-3">
                                    <form action="{{ route('dasboard.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3 form-floating">
                                            <select class="form-select" name="keluhan" aria-label="Default select example">
                                                <option selected disabled>Pilih Keluhan</option>
                                                <option value="keseleo">Keseleo</option>
                                                <option value="kurang nafsu makan">Kurang Nafsu Makan</option>
                                                <option value="pegal-pegal">Pegal-pegal</option>
                                                <option value="darah tinggi">Darah Tinggi</option>
                                                <option value="gula darah">Gula Darah</option>
                                                <option value="kram perut">Kram Perut</option>
                                                <option value="masuk angin">Masuk Angin</option>
                                            </select>
                                            <label for="formFloatingSelect">Keluhan</label>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <select class="form-select" name="tahun" aria-label="Default select example">
                                                <option selected disabled>Pilih Tahun Lahir</option>
                                                @for ($i = 1900; $i <= 2022; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <label for="formFloatingSelect">Keluhan</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Lihat Rekomendasi</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card p-3">
                                    @isset($data)
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th><strong>Nama Jamu</strong></th>
                                                    <td>: {{ $data['nama_jamu'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th><strong>Khasiat</strong></th>
                                                    <td>
                                                        @if ($data['nama_jamu'] == 'Beras Kencur')
                                                            : Mengobati keseleo dan kurang nafsu makan
                                                        @elseif($data['nama_jamu'] == 'Kunyit Asam')
                                                            : Mengobati pegal-pegal
                                                        @elseif($data['nama_jamu'] == 'Brotowali')
                                                            : Mengobati darah tinggi dan gula darah
                                                        @elseif($data['nama_jamu'] == 'Temulawak')
                                                            : Mengobati kram perut dan masuk angin
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><strong>Keluhan</strong></th>
                                                    <td>: {{ $data['keluhan'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th><strong>Umur</strong></th>
                                                    <td>: {{ $data['umur'] }} tahun</td>
                                                </tr>
                                                <tr>
                                                    <th><strong>Saran Penggunaan</strong></th>
                                                    <td>: {{ $data['saran'] }}, dalam 1 hari {{ $data['konsumsi'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
