@extends('layouts.app')
@section('judul', 'Komentar Foto')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Foto</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">Judul</th>
                        <td>{{ $foto->judul }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Deskripsi</th>
                        <td>{{ $foto->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal</th>
                        <td>{{ \Carbon\Carbon::parse($foto->tanggal)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Album</th>
                        <td>
                            @foreach ($albums as $album)
                                @if ($foto->id_album == $album->id_album)
                                    {{ $album->nama_album }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Gambar</th>
                        <td>
                            <img src="{{ asset('storage/' . $foto->gambar) }}" alt="{{ $foto->judul }}" class="img-fluid" style="max-width: 150px; height: auto;">
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Komentar</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('komentar.store', $foto->id_foto) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="komentar" class="form-label">Tinggalkan Komentar</label>
                    <textarea class="form-control" id="komentar" name="komentar" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>

            <hr>

            <h6>Daftar Komentar:</h6>
            <ul class="list-unstyled">
                @foreach ($komentar as $item)
                    <li class="border-bottom mb-2 pb-2">
                        <strong>{{ $item->user->username }}:({{$item->tanggal}})</strong>
                        <p>{{ $item->komentar }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
