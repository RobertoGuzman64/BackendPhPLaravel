<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;

    public $fillable = [
        "nombre",
        "propietarioId",
        "juegoId",
    ];

    public function juego()
    {
        return $this->belongsTo(Juego::class);
    }

    public function jugadores()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }
}
