@extends('layouts.app')

@section('judul', 'Upload Foto')

@section('content')
    <form action="/gallery" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
        </div>
        
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="id_album" class="form-label">Album</label>
            <select name="id_album" id="id_album" class="form-control" required>
                <option value="">Pilih Album</option>
                @foreach ($albums as $album)
                    <option value="{{ $album->id_album }}">{{ $album->nama_album }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Unggah Foto</button>
    </form>
@endsection
