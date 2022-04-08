<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Partida;

class PartidaController extends Controller
{
    // METODO DE MOSTRAR TODAS LAS PARTIDAS
    public function GETmostrarPartidas()
    {
        try {
            $partidas = Partida::all();
            return $partidas;
        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];
            if ($codigoError) {
                return "Error $codigoError";
            }
        }
    }
    // METODO DE CREAR PARTIDA
    public function POSTcrearPartida(Request $request)
    {
        $name = $request->input('name');
        $propietarioId = $request->input('propietarioId');
        $juegoId = $request->input('juegoId');
        try {
            return Partida::create(
                [
                    'name' => $name,
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
    public function POSTmostrarPartidaId(Request $request)
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
    public function PUTactualizaPartida(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $propietarioId = $request->input('propietarioId');
        $juegoId = $request->input('juegoId');
        try {
            $partida = Partida::find($id);
            $partida->name = $name;
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
}
