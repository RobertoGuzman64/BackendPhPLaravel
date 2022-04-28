<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Partida;

class PartidaController extends Controller
{
    // METODO DE MOSTRAR TODAS LAS PARTIDAS
    public function mostrarPartidas()
    {
        Log::info('mostrarPartidas()');
        try {
            $partidas = Partida::all();
            return $partidas;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE CREAR PARTIDA
    public function crearPartida(Request $request)
    {
        Log::info('crearPartida()');
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'propietarioId' => 'required|max:255',
                'juegoId' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed'], 400);
            }
            $partida = Partida::create([
                'nombre' => $request->nombre,
                'propietarioId' => $request->propietarioId,
                'juegoId' => $request->juegoId,
            ]);
            Log::info('Partida creada');
            return response()->json($partida, 200);
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }

    // METODO DE MOSTRAR PARTIDA POR ID
    public function mostrarPartidaId(Request $request)
    {
        Log::info('mostrarPartidaId()');
        $id = $request->input('id');
        try {
            $partida = Partida::find($id);
            return $partida;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }

    // METODO DE ACTUALIZAR PARTIDA
    public function actualizaPartida(Request $request, $id)
    {
        Log::info('actualizaPartida()');
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'propietarioId' => 'required|max:255',
                'juegoId' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Validación fallida'], 400);
            }
            $partida = Partida::find($id);
            $partida->nombre = $request->nombre;
            $partida->propietarioId = $request->propietarioId;
            $partida->juegoId = $request->juegoId;
            $partida->save();
            return $partida;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }

    // METODO DE BORRAR PARTIDA
    public function borrarPartida(Request $request)
    {
        Log::info('borrarPartida()');
        $id = $request->input('id');
        try {
            $partida = Partida::find($id);
            $partida->delete();
            return $partida;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
}
