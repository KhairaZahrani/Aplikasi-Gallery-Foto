<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\Like;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){
        $totalAlbum = Album::count();
        $totalFoto = Foto::count();
        $totalKomentar = Komentar::count();
        $totalLike = Like::count();
        return view('dashboard', compact('totalAlbum', 'totalFoto', 'totalKomentar', 'totalLike'));
    }
}
