<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Enlaces a la clases que contienen los métodos de la API
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\JugadorController;

// http://localhost:8000/api/ ENDPOINT LOCAL
// https://phplaravelbackend.herokuapp.com/api/ ENDPOINT HEROKU

// ENDPOINTS DE AUTENTIFICACIÓN / USUARIOS //
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);


// ENDPOINTS DE AUTENTIFICACIÓN / USUARIOS / MIDDLEWARE //
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/me', [UserController::class, 'me']);
    Route::put('/actualizarUsuario', [UserController::class, 'PUTactualizarUsuario']);
    Route::delete('/borrarUsuario/{id}', [UserController::class, 'DELETEborrarUsuario']);
});

// ENDPOINTS DE PARTIDA //
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/partidas', [PartidaController::class, "GETmostrarPartidas"]);
    Route::post('/partidas', [PartidaController::class, "POSTcrearPartida"]);
    Route::post('/partidaId', [PartidaController::class, "POSTmostrarPartidaId"]);
    Route::put('/partidaActualiza', [PartidaController::class, "PUTactualizaPartida"]);
    Route::delete('/partidaBorrar', [PartidaController::class, "DELETEborrarPartida"]);
});

// ENDPOINTS DE JUEGO //
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/juegos', [JuegoController::class, "GETmostrarJuegos"]);
    Route::post('/juegos', [JuegoController::class, "POSTcrearJuego"]);
    Route::post('/juegoId', [JuegoController::class, "POSTmostrarJuegoId"]);
    Route::put('/juegoActualiza', [JuegoController::class, "PUTactualizaJuego"]);
    Route::delete('/juegoBorrar', [JuegoController::class, "DELETEborrarJuego"]);
});

// ENPOINTS DE MENSAJES //
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/mensajes', [MensajeController::class, "GETmostrarMensajes"]);
    Route::post('/mensajesPartidaId', [MensajeController::class, "POSTmensajesPartidaId"]);
    Route::post('/mensajes', [MensajeController::class, "POSTcrearMensaje"]);
    Route::post('/mensajeId', [MensajeController::class, "POSTmostrarMensajeId"]);
    Route::put('/mensajeActualiza', [MensajeController::class, "PUTactualizaMensaje"]);
    Route::delete('/mensajeBorrar', [MensajeController::class, "DELETEborrarMensaje"]);
});

// ENDPOINTS DE JUGADORES //
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/jugadores', [JugadorController::class, "GETmostrarJugadores"]);
    Route::post('/jugadores', [JugadorController::class, "POSTcrearJugador"]);
    Route::post('/jugadorId', [JugadorController::class, "POSTmostrarJugadorId"]);
    Route::post('/jugadorPartidaId', [JugadorController::class, "POSTmostrarJugadorPartidaId"]);
    Route::post('/jugadorUsuarioId', [JugadorController::class, "POSTmostrarJugadorUsuarioId"]);
    Route::put('/jugadorActualiza', [JugadorController::class, "PUTactualizaJugador"]);
    Route::delete('/jugadorBorrar', [JugadorController::class, "DELETEborrarJugador"]);
});
