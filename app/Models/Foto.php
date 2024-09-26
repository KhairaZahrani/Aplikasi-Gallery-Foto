<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_foto';
    protected $table = 'foto';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'gambar',
        'alamat',
        'id_album',
        'id_user',

    ];
    
    public function album()
{
    return $this->belongsTo(Album::class, 'id_album', 'id_album');
}

public function like()
{
    return $this->hasMany(Like::class, 'id_foto');
}

}
