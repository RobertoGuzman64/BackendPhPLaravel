<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\Models\Partida;

class PartidaController extends Controller
{
    // METODO DE MOSTRAR TODAS LAS PARTIDAS
    public function mostrarPartidas()
    {
        try {
            $partidas = Partida::all();
            return $partidas;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }else{
                
            }
        }
    }
    // METODO DE CREAR PARTIDA
    public function crearPartida(Request $request)
    {
        $nombre = $request->input('nombre');
        $propietarioId = $request->input('propietarioId');
        $juegoId = $request->input('juegoId');
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'propietarioId' => 'required|max:255',
                'juegoId' => 'required|max:255',
            ]);
            return Partida::create(
                [
                    'nombre' => $nombre,
                    'propietarioId' => $propietarioId,
                    'juegoId' => $juegoId
                ]
            );
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }

    // METODO DE MOSTRAR PARTIDA POR ID
    public function mostrarPartidaId(Request $request)
    {
        $id = $request->input('id');
        try {
            $partida = Partida::find($id);
            return $partida;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }

    // METODO DE ACTUALIZAR PARTIDA
    public function actualizaPartida(Request $request)
    {
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $propietarioId = $request->input('propietarioId');
        $juegoId = $request->input('juegoId');
        try {
            $partida = Partida::find($id);
            $partida->nombre = $nombre;
            $partida->propietarioId = $propietarioId;
            $partida->juegoId = $juegoId;
            $partida->save();
            return $partida;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }

    // METODO DE BORRAR PARTIDA
    public function borrarPartida(Request $request)
    {
        $id = $request->input('id');
        try {
            $partida = Partida::find($id);
            $partida->delete();
            return $partida;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
}
