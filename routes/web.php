<?php

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
Route::get('/', [SessaoController::class, 'new']);
Route::get('/deslogar', [SessaoController::class, 'back']);
Route::post('/logar', [SessaoController::class, 'create']);

Route::get('/sistema', [SistemaController::class, 'exibir']);




