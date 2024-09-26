<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
   
    public function index()
    {
        $foto = Foto::withCount('like')->get();
        $album = Album::all();
        return view('gallery.index', compact('foto','album'));
    }

    public function create()
    {
        $albums = Album::all();
        return view('gallery.create', compact('albums'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_album' => 'required|exists:album,id_album',
        ]);
    
        // Simpan gambar ke storage
        $path = $request->file('gambar')->store('images', 'public');
    
        // Simpan data foto ke database
        Foto::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'gambar' => $path, // Simpan path gambar
            'id_album' => $request->id_album,
            'id_user' => auth()->id(), // Mengambil ID pengguna yang sedang login
        ]);
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('gallery.index')->with('pesan', 'Foto berhasil diunggah.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foto = Foto::findOrFail($id); 
        $albums = Album::all(); 
        return view('gallery.edit', compact('foto', 'albums'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'tanggal' => 'required|date',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'id_album' => 'required|exists:album,id_album',
    ]);

    $foto = Foto::findOrFail($id);

    if ($request->hasFile('gambar')) {
        if ($foto->gambar && file_exists(storage_path('app/public/' . $foto->gambar))) {
            unlink(storage_path('app/public/' . $foto->gambar));
        }

        // Simpan gambar baru
        $path = $request->file('gambar')->store('images', 'public');
        $foto->gambar = $path;
    }

    // Update data foto
    $foto->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'tanggal' => $request->tanggal,
        'id_album' => $request->id_album,
    ]);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('gallery.index')->with('pesan', 'Foto berhasil diupdate.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Foto::where('id_foto', $id)->firstOrFail(); 

        $gallery->delete();

        return redirect('/gallery')->with('pesan', 'Foto berhasil dihapus');
    }
}
