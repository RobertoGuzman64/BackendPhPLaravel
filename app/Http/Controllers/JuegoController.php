<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\Juego;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    // METODO DE MOSTRAR TODOS LOS JUEGOS
    public function mostrarJuegos()
    {
        Log::info('mostrarJuegos()');
        try {
            $juegos = Juego::all();
            return $juegos;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE CREAR JUEGO
    public function crearJuego(Request $request)
    {
        Log::info('crearJuego()');
        try {
            $validator = Validator::make($request->all(), [
                'titulo' => 'required|string|max:255',
                'imagenJuegoURL' => 'required|string|max:255',
                'juegoURL' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Validación fallida'], 400);
            }
            $juego = Juego::create([
                'titulo' => $request->titulo,
                'imagenJuegoURL' => $request->imagenJuegoURL,
                'juegoURL' => $request->juegoURL,
            ]);
            Log::info('Juego creado');
            return response()->json($juego, 200);
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE MOSTRAR UN JUEGO POR ID
    public function mostrarJuegoId(Request $request)
    {
        Log::info('mostrarJuegoId()');
        $id = $request->input('id');
        try {
            $juego = Juego::find($id);
            return $juego;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE ACTUALIZAR UN JUEGO
    public function actualizaJuego(Request $request, $id)
    {
        Log::info('actualizaJuego()');
        try {
            $validator = Validator::make($request->all(), [
                'titulo' => 'required|string|max:255',
                'imagenJuegoURL' => 'required|string|max:255',
                'juegoURL' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Validación fallida'], 400);
            }
            $juego = Juego::find($id);
            $juego->titulo = $request->titulo;
            $juego->imagenJuegoURL = $request->imagenJuegoURL;
            $juego->juegoURL = $request->juegoURL;
            $juego->save();
            Log::info('Juego actualizado');
            return response()->json($juego, 200);
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE ELIMINAR UN JUEGO
    public function borrarJuego(Request $request)
    {
        Log::info('borrarJuego()');
        $id = $request->input('id');
        try {
            $juego = Juego::find($id);
            $juego->delete();
            return "Juego Borrado";
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
}
