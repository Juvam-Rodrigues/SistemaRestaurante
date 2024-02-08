<?php

use App\Http\Controllers\ComandaController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\SessaoController;
use App\Http\Controllers\SistemaController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Sessão
Route::get('/', [SessaoController::class, 'nova']);
Route::get('/deslogar', [SessaoController::class, 'voltar']);
Route::post('/logar', [SessaoController::class, 'criar']);

//Sistema
Route::get('/sistema', [SistemaController::class, 'exibir']);

//Mesa
Route::post('/mesas/adicionar', [MesaController::class, 'criar']);
Route::post('/mesas/apagar/{id}', [MesaController::class, 'apagar']);
Route::get('/mesas/acessar/{id}', [MesaController::class, 'acessar']);

//Comandas 
Route::post('/comandas/adicionar', [ComandaController::class, 'criar']);
Route::post('/comandas/apagar/{id}', [ComandaController::class, 'apagar']);






