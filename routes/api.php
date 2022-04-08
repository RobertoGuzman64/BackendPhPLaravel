<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Enlaces a la clases que contienen los métodos de la API
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartidaController;

// ENDPOINTS DE AUTENTIFICACIÓN //
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'me']);
});

    // ENDPOINTS DE PARTIDA //
    Route::get('/partidas', [PartidaController::class, "GETmostrarPartidas"]);
    Route::post('/partidas', [PartidaController::class, "POSTcrearPartida"]);
    Route::post('/partidaId', [PartidaController::class, "POSTmostrarPartidaId"]);
    Route::put('/partidaActualiza', [PartidaController::class, "PUTactualizaPartida"]);
    Route::delete('/partidaBorrar', [PartidaController::class, "DELETEborrarPartida"]);











    
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