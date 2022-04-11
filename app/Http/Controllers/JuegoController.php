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
    public function POSTcrearJuego(Request $request)
    {
        $titulo = $request->input('titulo');
        $imagenJuegoURL = $request->input('imagenJuegoURL');
        $juegoURL = $request->input('juegoURL');
        try {
            return Juego::create(
                [
                    'titulo' => $titulo,
                    'imagenJuegoURL' => $imagenJuegoURL,
                    'juegoURL' => $juegoURL,
                ]
            );
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    // METODO DE MOSTRAR UN JUEGO POR ID
    public function POSTmostrarJuegoId(Request $request)
    {
        $id = $request->input('id');
        try {
            $juego = Juego::find($id);
            return $juego;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    // METODO DE ACTUALIZAR UN JUEGO
    public function PUTactualizaJuego(Request $request)
    {
        $id = $request->input('id');
        $titulo = $request->input('titulo');
        $imagenJuegoURL = $request->input('imagenJuegoURL');
        $juegoURL = $request->input('juegoURL');
        try {
            $juego = Juego::find($id);
            $juego->titulo = $titulo;
            $juego->imagenJuegoURL = $imagenJuegoURL;
            $juego->juegoURL = $juegoURL;
            $juego->save();
            return $juego;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    // METODO DE ELIMINAR UN JUEGO
    public function DELETEborrarJuego(Request $request)
    {
        $id = $request->input('id');
        try {
            $juego = Juego::find($id);
            $juego->delete();
            return "Juego Borrado";
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
}
