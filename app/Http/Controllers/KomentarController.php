<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\Like;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    function index($id_foto){
        $foto = Foto::findOrFail($id_foto); 
        $albums = Album::all();
        $komentar = Komentar::where('id_foto', $id_foto)->get();
        return view('gallery.komentar', compact('foto','komentar','albums'));
    }

    public function store(Request $request, $id_foto)
    {
        $request->validate([
            'komentar' => 'required|string|max:255',
        ]);

        Komentar::create([
            'id_foto' => $id_foto,
            'id_user' => auth()->id(),
            'komentar' => $request->komentar, 
            'tanggal' => now(),
        ]);

        return redirect()->route('komentar.index', $id_foto)->with('pesan', 'Komentar berhasil ditambahkan!');
    }

    public function like(Request $request, $id_foto)
{
    // Cek apakah user sudah menyukai foto ini
    $existingLike = Like::where('id_foto', $id_foto)
        ->where('id_user', auth()->id())
        ->first();

    if ($existingLike) {
        // Jika sudah ada, hapus like (unlike)
        $existingLike->delete();
    } else {
        // Jika belum ada, tambahkan like
        Like::create([
            'id_foto' => $id_foto,
            'id_user' => auth()->id(),
            'tanggal' => now(),
        ]);
    }

    // Redirect kembali ke halaman sebelumnya
    return redirect()->back();
}


}
