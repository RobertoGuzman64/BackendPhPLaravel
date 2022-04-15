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
    public function GETmensajePartidaId(Request $request)
    {
        try {
            $mensajes = Mensaje::where('id_partida', $request->input('id_partida'))->get();
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
        try {
            $mensaje = new Mensaje();
            $mensaje->id_usuario = $request->input('id_usuario');
            $mensaje->id_partida = $request->input('id_partida');
            $mensaje->mensaje = $request->input('mensaje');
            $mensaje->save();
            return $mensaje;
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
        try {
            $mensaje = Mensaje::find($request->input('id'));
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
        try {
            $mensaje = Mensaje::find($request->input('id'));
            $mensaje->id_usuario = $request->input('id_usuario');
            $mensaje->id_partida = $request->input('id_partida');
            $mensaje->mensaje = $request->input('mensaje');
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
