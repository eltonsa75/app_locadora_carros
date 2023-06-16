<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::resource('cliente', 'App\Http\Controllers\ClienteController');
Route::ApiResource('cliente', 'App\Http\Controllers\ClienteController');
Route::ApiResource('carro', 'App\Http\Controllers\CarroController');
Route::ApiResource('locacao', 'App\Http\Controllers\LocacaoController');
Route::ApiResource('marca', 'App\Http\Controllers\MarcaController');
Route::ApiResource('modelo', 'App\Http\Controllers\ModeloController');
