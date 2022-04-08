<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;
    public $fillable = [
        "titulo",
        "imagenJuegoURL",
        "juegoURL",
    ];
    public function partidas()
    {
        return $this->hasMany(Partida::class);
    }
}
