@extends('layouts.app')
@section('judul', 'Gallery Foto')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <a href="/gallery/create" class="btn btn-primary">+ Membuat Gallery Foto</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Album</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Like</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($foto as $item)
        <tr>
            <td>
                <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" style="width: 200px; height: auto;">
                </a>
            </td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->album->nama_album ? $item->album->nama_album : 'Album Tidak Diketahui' }}</td>
            <td>{{ $item->deskripsi }}</td>
            <td>{{ $item->tanggal }}</td>
            <td>
                {{ $item->like->count() ?? 0 }}
              
            </td>
            <td>
                <div class="d-flex gap-2">
                    <form action="{{ route('komentar.like', $item->id_foto) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">
                            {{ $item->like->where('id_user', auth()->id())->count() ? 'Unlike' : 'Like' }}
                        </button>
                    </form>
                    <a class="btn btn-warning btn-sm" href="{{ url('/komentar/' . $item->id_foto) }}">Komentar</a>
                    @if ($item->id_user === auth()->id())
                    <a class="btn btn-primary btn-sm" href="/gallery/{{ $item->id_foto }}/edit">Edit</a>
                    <form class="d-inline" action="{{ '/gallery/'.$item->id_foto }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
