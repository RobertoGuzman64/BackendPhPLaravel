<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Enlace a la clase que contiene los métodos de la API HomeController
use App\Http\Controllers\AuthController;


//**************************//
//ENDPOINTS DE AUTENTICACIÓN//
//**************************//

Route::post('/register', [AuthController::class, 'register']);

Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'me']);
});






