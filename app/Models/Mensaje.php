<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;
    public $fillable = [
        'mensaje',
        'fecha',
        'usuarioId',
        'partidaId'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function partidas()
    {
        return $this->belongsTo(Partida::class);
    }
    
}
