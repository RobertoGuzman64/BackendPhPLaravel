<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\Juego;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    // METODO DE MOSTRAR TODOS LOS JUEGOS
    public function GETmostrarJuegos()
    {
        try {
            $juegos = Juego::all();
            return $juegos;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    // METODO DE CREAR JUEGO
    
}
