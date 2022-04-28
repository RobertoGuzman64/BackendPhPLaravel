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
    Route::put('/usuarioActualiza/{id}', [UserController::class, 'actualizaUsuario']);
    Route::delete('/borrarUsuario/{id}', [UserController::class, 'borrarUsuario']);
});

// ENDPOINTS DE PARTIDA //
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/partidas', [PartidaController::class, "mostrarPartidas"]);
    Route::get('/partidaId', [PartidaController::class, "mostrarPartidaId"]);
    Route::post('/partidas', [PartidaController::class, "crearPartida"]);
    Route::put('/partidaActualiza/{id}', [PartidaController::class, "actualizaPartida"]);
    Route::delete('/partidaBorrar', [PartidaController::class, "borrarPartida"]);
});

// ENDPOINTS DE JUEGO //
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/juegos', [JuegoController::class, "mostrarJuegos"]);
    Route::get('/juegoId', [JuegoController::class, "mostrarJuegoId"]);
    Route::post('/juegos', [JuegoController::class, "crearJuego"]);
    Route::put('/juegoActualiza/{id}', [JuegoController::class, "actualizaJuego"]);
    Route::delete('/juegoBorrar', [JuegoController::class, "borrarJuego"]);
});

// ENPOINTS DE MENSAJES //
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/mensajes', [MensajeController::class, "mostrarMensajes"]);
    Route::get('/mensajeId', [MensajeController::class, "mostrarMensajeId"]);
    Route::get('/mensajesPartidaId', [MensajeController::class, "mensajesPartidaId"]);
    Route::post('/mensajes', [MensajeController::class, "crearMensaje"]);
    Route::put('/mensajeActualiza/{id}', [MensajeController::class, "actualizaMensaje"]);
    Route::delete('/mensajeBorrar', [MensajeController::class, "borrarMensaje"]);
});

// ENDPOINTS DE JUGADORES //
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/jugadores', [JugadorController::class, "mostrarJugadores"]);
    Route::get('/jugadorId', [JugadorController::class, "mostrarJugadorId"]);
    Route::get('/jugadorPartidaId', [JugadorController::class, "mostrarJugadorPartidaId"]);
    Route::get('/jugadorUsuarioId', [JugadorController::class, "mostrarJugadorUsuarioId"]);
    Route::post('/jugadores', [JugadorController::class, "crearJugador"]);
    Route::put('/jugadorActualiza', [JugadorController::class, "actualizaJugador"]);
    Route::delete('/jugadorBorrar', [JugadorController::class, "borrarJugador"]);
});
