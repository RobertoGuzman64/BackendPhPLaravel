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
        'jugadorId',
        'partidaId'
    ];

    public function Jugadores()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function Partidas()
    {
        return $this->belongsTo(Partida::class);
    }
    
}
