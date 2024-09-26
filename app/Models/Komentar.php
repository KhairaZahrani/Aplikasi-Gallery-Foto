<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_komentar';
    protected $table = 'komentar';

    protected $fillable = [
        'id_foto',
        'id_user',
        'komentar',
        'tanggal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function foto()
    {
        return $this->belongsTo(Foto::class, 'id_foto');
    }
}
