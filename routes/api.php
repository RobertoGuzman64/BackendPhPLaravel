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

// ENDPOINTS DE AUTENTIFICACIÓN / USUARIOS //
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::delete('/borrarUsuario/{id}', [UserController::class, 'DELETEborrarUsuario']);
Route::put('/actualizarUsuario', [UserController::class, 'PUTactualizarUsuario']);

// ENDPOINTS DE AUTENTIFICACIÓN / USUARIOS / MIDDLEWARE //
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/me', [UserController::class, 'me']);
});

// ENDPOINTS DE PARTIDA //
Route::get('/partidas', [PartidaController::class, "GETmostrarPartidas"]);
Route::post('/partidas', [PartidaController::class, "POSTcrearPartida"]);
Route::post('/partidaId', [PartidaController::class, "POSTmostrarPartidaId"]);
Route::put('/partidaActualiza', [PartidaController::class, "PUTactualizaPartida"]);
Route::delete('/partidaBorrar', [PartidaController::class, "DELETEborrarPartida"]);

// ENDPOINTS DE JUEGO //
Route::get('/juegos', [JuegoController::class, "GETmostrarJuegos"]);
Route::post('/juegos', [JuegoController::class, "POSTcrearJuego"]);
Route::post('/juegoId', [JuegoController::class, "POSTmostrarJuegoId"]);
Route::put('/juegoActualiza', [JuegoController::class, "PUTactualizaJuego"]);
Route::delete('/juegoBorrar', [JuegoController::class, "DELETEborrarJuego"]);

// ENPOINTS DE MENSAJES //
Route::get('/mensajes', [MensajeController::class, "GETmostrarMensajes"]);
Route::get('/mensajePartidaId', [MensajeController::class, "GETmensajePartidaId"]);
Route::post('/mensajes', [MensajeController::class, "POSTcrearMensaje"]);
Route::post('/mensajeId', [MensajeController::class, "POSTmostrarMensajeId"]);
Route::put('/mensajeActualiza', [MensajeController::class, "PUTactualizaMensaje"]);
Route::delete('/mensajeBorrar', [MensajeController::class, "DELETEborrarMensaje"]);

// ENDPOINTS DE JUGADORES //
Route::get('/jugadores', [JugadorController::class, "GETmostrarJugadores"]);
Route::post('/jugadores', [JugadorController::class, "POSTcrearJugador"]);
Route::post('/jugadorId', [JugadorController::class, "POSTmostrarJugadorId"]);
Route::post('/jugadorPartidaId', [JugadorController::class, "POSTmostrarJugadorPartidaId"]);
Route::post('/jugadorUsuarioId', [JugadorController::class, "POSTmostrarJugadorUsuarioId"]);
Route::put('/jugadorActualiza', [JugadorController::class, "PUTactualizaJugador"]);
Route::delete('/jugadorBorrar', [JugadorController::class, "DELETEborrarJugador"]);






    
// Los requisitos funcionales de la aplicación son los siguientes:
// ● RF.1 Los usuarios se tienen que poder registrar a la aplicación,
// estableciendo un usuario/contraseña.

// ● RF.2 Los usuarios tienen que autenticarse a la aplicación haciendo login.

// ● RF.3 Los usuarios tienen que poder crear Partídas (grupos) para
// un determinado videojuego.

// ● RF.4 Los usuarios tienen que poder buscar Partídas seleccionando
// un videojuego.

// Prueba técnica

// 2

// ● RF.5 Los usuarios pueden entrar y salir de una Party.

// ● RF.6 Los usuarios tienen que poder enviar mensajes a la Party. Estos
// mensajes tienen que poder ser editados y borrados por su usuario creador.

// ● RF.7 Los mensajes que existan en una Party se tienen que visualizar como
// un chat común.

// ● RF.8 Los usuarios pueden introducir y modificar sus datos de perfil, por
// ejemplo, su usuario de Steam.

// ● RF.9 Los usuarios tienen que poder hacer logout de la aplicación web.