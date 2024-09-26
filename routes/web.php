<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\SessionCotroller;
use App\Models\Komentar;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [SessionCotroller::class, 'index']);
Route::post('/login', [SessionCotroller::class, 'login']);
Route::get('/register', [SessionCotroller::class, 'register']);
Route::post('/register', [SessionCotroller::class, 'create']);


Route::get('/', [DashboardController::class, 'index']);

Route::resource('gallery', GalleryController::class);

Route::get('/komentar/{id_foto}', [KomentarController::class, 'index'])->name('komentar.index');
Route::post('/komentar/{id_foto}', [KomentarController::class, 'store'])->name('komentar.store');

Route::post('/komentar/{id_foto}/like', [KomentarController::class, 'like'])->name('komentar.like');
