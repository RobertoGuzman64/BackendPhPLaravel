<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Jugador;

class JugadorController extends Controller
{
    // METODO DE MOSTRAR TODOS LOS JUGADORES
    public function GETmostrarJugadores(){
        try {
            $jugadores = Jugador::all();
            return $jugadores;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }
        }
    }
}
