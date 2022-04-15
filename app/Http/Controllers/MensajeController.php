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
}
