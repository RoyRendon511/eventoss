<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CiudadesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('eventos', EventosController::class);
Route::resource('ciudades', CiudadesController::class);
Route::get('eventosall',[EventosController::class, 'all']);
Route::get('eventosPorCiudad',[EventosController::class, 'eventosPorCiudad']);