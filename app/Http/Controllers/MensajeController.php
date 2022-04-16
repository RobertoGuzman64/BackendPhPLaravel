<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Mensaje;

class MensajeController extends Controller
{
    // METODO DE MOSTRAR TODOS LOS MENSAJES
    public function GETmostrarMensajes()
    {
        try {
            $mensajes = Mensaje::all();
            return $mensajes;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    // METODO DE MOSTRAR MENSAJES DE UNA PARTIDA
    public function POSTmensajesPartidaId(Request $request)
    {
        $partidaId = $request->input('partidaId');
        try {
            $mensajes = Mensaje::where('partidaId', $partidaId)->get();
            return $mensajes;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    // METODO DE CREAR UN MENSAJE
    public function POSTcrearMensaje(Request $request)
    {
        $mensaje = $request->input('mensaje');
        $fecha = $request->input('fecha');
        $usuarioId = $request->input('usuarioId');
        $partidaId = $request->input('partidaId');
        try {
            return Mensaje::create(
                [
                    'mensaje' => $mensaje,
                    'fecha' => $fecha,
                    'usuarioId' => $usuarioId,
                    'partidaId' => $partidaId
                ]
            );
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    // METODO DE MOSTRAR UN MENSAJE POR ID
    public function POSTmostrarMensajeId(Request $request)
    {
        $id = $request->input('id');
        try {
            $mensaje = Mensaje::find($id);
            return $mensaje;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    // METODO DE ACTUALIZAR UN MENSAJE
    public function PUTactualizaMensaje(Request $request)
    {
        $id = $request->input('id');
        try {
            $mensaje = Mensaje::find($id);
            $mensaje->mensaje = $request->input('mensaje');
            $mensaje->usuarioId = $request->input('usuarioId');
            $mensaje->partidaId = $request->input('partidaId');
            $mensaje->save();
            return $mensaje;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    // METODO DE ELIMINAR UN MENSAJE
    public function DELETEborrarMensaje(Request $request)
    {
        try {
            $mensaje = Mensaje::find($request->input('id'));
            $mensaje->delete();
            return $mensaje;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
}
