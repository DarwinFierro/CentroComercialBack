<?php

use App\Http\Controllers\ComercioController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\TipoDocumentoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoComercioController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*login*/
Route::post('login', [UsuarioController::class, 'login']);

/*Comercio*/
Route::get('/comercio', [ComercioController::class, 'index']);
/*Usuario*/
Route::get('/usuario', [UsuarioController::class, 'index']);
Route::post('/usuario', [UsuarioController::class, 'store']);
Route::get('/usuario/local', [UsuarioController::class, 'local']);
Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
Route::put('/usuario/{id}', [UsuarioController::class, 'update']);
/*TipoDocumento*/
Route::get('/tipoDocumento', [TipoDocumentoController::class, 'index']);
/*TipoComercio*/
Route::get('/tipoComercio', [TipoComercioController::class, 'index']);
/*Estado*/
Route::get('/estado', [EstadoController::class, 'index']);

/*Rol*/
Route::get('/rol', [RolController::class, 'index']);
/*Local*/
Route::get('/local', [LocalController::class, 'index']);
Route::get('/local/{id}', [LocalController::class, 'show']);
Route::post('/local', [LocalController::class, 'store']);
Route::put('/local/{id}', [LocalController::class, 'update']);
Route::delete('/local/{id}', [LocalController::class, 'delete']);
