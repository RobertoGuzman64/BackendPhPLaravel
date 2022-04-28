<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Jugador;

class JugadorController extends Controller
{
    // METODO DE MOSTRAR TODOS LOS JUGADORES
    public function mostrarJugadores()
    {
        Log::info('mostrarJugadores()');
        try {
            $jugadores = Jugador::all();
            return $jugadores;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE CREAR UN JUGADOR
    public function crearJugador(Request $request)
    {
        Log::info('crearJugador()');
        try {
            $validator = Validator::make($request->all(), [
                'partidaId' => 'required|max:255',
                'usuarioId' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Validación fallida'], 400);
            }
            $jugador = Jugador::create([
                'partidaId' => $request->partidaId,
                'usuarioId' => $request->usuarioId,
            ]);
            Log::info('Jugador creado');
            return response()->json($jugador, 200);
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE MOSTRAR UN JUGADOR POR ID
    public function mostrarJugadorId(Request $request)
    {
        Log::info('mostrarJugadorId()');
        $jugadorId = $request->input('jugadorId');
        try {
            $jugador = Jugador::find($jugadorId);
            return $jugador;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE MOSTRAR UN JUGADOR POR PARTIDA ID
    public function mostrarJugadorPartidaId(Request $request)
    {
        Log::info('mostrarJugadorPartidaId()');
        $partidaId = $request->input('partidaId');
        try {
            $jugador = Jugador::where('partidaId', $partidaId)->get();
            return $jugador;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE MOSTRAR UN JUGADOR POR USUARIO ID
    public function mostrarJugadorUsuarioId(Request $request)
    {
        Log::info('mostrarJugadorUsuarioId()');
        $usuarioId = $request->input('usuarioId');
        try {
            $jugador = Jugador::where('usuarioId', $usuarioId)->get();
            return $jugador;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE ACTUALIZAR UN JUGADOR
    public function actualizaJugador(Request $request, $id)
    {
        Log::info('actualizaJugador()');
        try {
            $validator = Validator::make($request->all(), [
                'partidaId' => 'required|max:255',
                'usuarioId' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Validación fallida'], 400);
            }
            $jugador = Jugador::find($id);
            $jugador->partidaId = $request->partidaId;
            $jugador->usuarioId = $request->usuarioId;
            $jugador->save();
            Log::info('Jugador actualizado');
            return response()->json($jugador, 200);
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE ELIMINAR UN JUGADOR
    public function borrarJugador(Request $request)
    {
        Log::info('borrarJugador()');
        $id = $request->input('id');
        try {
            $jugador = Jugador::find($id);
            $jugador->delete();
            return $jugador;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
}