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
    // METODO DE CREAR UN JUGADOR
    public function POSTcrearJugador(Request $request){
        $partidaId = $request->input('partidaId');
        $usuarioId = $request->input('usuarioId');
        try {
            return Jugador::create(
                [
                    'partidaId' => $partidaId,
                    'usuarioId' => $usuarioId
                ]
            );
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }
        }
    }
    // METODO DE MOSTRAR UN JUGADOR POR ID
    public function POSTmostrarJugadorId(Request $request){
        $jugadorId = $request->input('jugadorId');
        try {
            $jugador = Jugador::find($jugadorId);
            return $jugador;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }
        }
    }
    // METODO DE MOSTRAR UN JUGADOR POR PARTIDA ID
    public function POSTmostrarJugadorPartidaId(Request $request){
        $partidaId = $request->input('partidaId');
        try {
            $jugador = Jugador::where('partidaId', $partidaId)->get();
            return $jugador;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }
        }
    }
    // METODO DE MOSTRAR UN JUGADOR POR USUARIO ID
    public function POSTmostrarJugadorUsuarioId(Request $request){
        $usuarioId = $request->input('usuarioId');
        try {
            $jugador = Jugador::where('usuarioId', $usuarioId)->get();
            return $jugador;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if($codigoError){
                return "Error $codigoError";
            }
        }
    }
}
