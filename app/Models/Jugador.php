<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    public $fillable = [
        'partidaId',
        'usuarioId',
    ];
    
    public function partidas()
    {
        return $this->belongsTo(Partida::class);
    }

    public function usuarios()
    {
        return $this->belongsTo(Usuario::class);
    }
    
}
