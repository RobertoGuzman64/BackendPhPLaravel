<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Mensaje;

class MensajeController extends Controller
{
    // METODO DE MOSTRAR TODOS LOS MENSAJES
    public function mostrarMensajes()
    {
        Log::info('mostrarMensajes()');
        try {
            $mensajes = Mensaje::all();
            return $mensajes;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE CREAR UN MENSAJE
    public function crearMensaje(Request $request)
    {
        Log::info('crearMensaje()');
        try {
            $validator = Validator::make($request->all(), [
                'mensaje' => 'required|string|max:255',
                'fecha' => 'required|string|max:15',
                'usuarioId' => 'required|integer',
                'partidaId' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Validación fallida'], 400);
            }
            $mensaje = Mensaje::create([
                'mensaje' => $request->mensaje,
                'fecha' => $request->fecha,
                'usuarioId' => $request->usuarioId,
                'partidaId' => $request->partidaId,
            ]);
            Log::info('Mensaje creado');
            return response()->json($mensaje, 200);
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE MOSTRAR MENSAJES DE UNA PARTIDA
    public function mensajesPartidaId(Request $request)
    {
        Log::info('mensajesPartidaId()');
        $partidaId = $request->input('partidaId');
        try {
            $mensajes = Mensaje::where('partidaId', $partidaId)->get();
            return $mensajes;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE MOSTRAR UN MENSAJE POR ID
    public function mostrarMensajeId(Request $request)
    {
        Log::info('mostrarMensajeId()');
        $id = $request->input('id');
        try {
            $mensaje = Mensaje::find($id);
            return $mensaje;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE ACTUALIZAR UN MENSAJE
    public function actualizaMensaje(Request $request, $id)
    {
        Log::info('actualizaMensaje()');
        try {
            $validator = Validator::make($request->all(), [
                'mensaje' => 'required|string|max:255',
                'fecha' => 'required|string|max:15',
                'usuarioId' => 'required|integer',
                'partidaId' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Validación fallida'], 400);
            }
            $mensaje = Mensaje::find($id);
            $mensaje->mensaje = $request->mensaje;
            $mensaje->fecha = $request->fecha;
            $mensaje->usuarioId = $request->usuarioId;
            $mensaje->partidaId = $request->partidaId;
            $mensaje->save();
            Log::info('Mensaje actualizado');
            return response()->json($mensaje, 200);
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
    // METODO DE ELIMINAR UN MENSAJE
    public function borrarMensaje(Request $request)
    {
        Log::info('borrarMensaje()');
        try {
            $mensaje = Mensaje::find($request->input('id'));
            $mensaje->delete();
            return $mensaje;
        } catch (QueryException $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Algo salió mal'], 500);
        }
    }
}
