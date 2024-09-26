@extends('layouts.app')
@section('judul', 'Edit Foto')

@section('content')
<div class="container">
    <h1>Edit Foto</h1>

    <form action="{{ url('/gallery/' . $foto->id_foto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $foto->judul }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $foto->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $foto->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label for="album" class="form-label">Album</label>
            <select class="form-control" id="album" name="id_album" required>
                @foreach ($albums as $album)
                    <option value="{{ $album->id_album }}" {{ $foto->id_album == $album->id_album ? 'selected' : '' }}>
                        {{ $album->nama_album }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
            <p class="mt-2">Gambar saat ini:</p>
            <img src="{{ asset('storage/' . $foto->gambar) }}" alt="{{ $foto->judul }}" style="width: 150px; height: auto;">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
