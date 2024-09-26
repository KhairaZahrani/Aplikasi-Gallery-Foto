<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_like';
    protected $table = 'like';

    protected $fillable = [
        'id_foto',
        'id_user',
        'tanggal',
    ];

    public function foto()
{
    return $this->belongsTo(Foto::class, 'id_foto');
}

public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}
}
