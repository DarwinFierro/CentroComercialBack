<?php

use App\Http\Controllers\ComercioController;
use App\Http\Controllers\EstadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
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
/*Comercio*/
Route::get('/comercio', [ComercioController::class, 'index']);
/*Usuario*/
Route::get('/usuario', [UsuarioController::class, 'index']);
Route::post('/usuario', [UsuarioController::class, 'store']);
