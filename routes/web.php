<?php

use App\Http\Controllers\ComandaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\SessaoController;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\PedidoController;

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
Route::get('/comandas/pagamento/{comanda_id}/{metodo_pagamento}/{desconto}', [ComandaController::class, 'pagamento'])->name('pagamento');
Route::get('/comandas/acessar/{id}', [ComandaController::class, 'acessar']);
Route::get('/comandas/guardar', [ComandaController::class, 'guardar'])->name('guardar');

//Produtos
Route::post('/produtos/adicionar', [ProdutoController::class, 'criar']);
Route::post('/produtos/apagar/{id}', [ProdutoController::class, 'apagar']);
Route::get('/produtos/listar/{comanda_id}/{categoria}', [ProdutoController::class, 'listarPorCategoria']);

//Pedidos
Route::get('/pedidos/adicionar/produto/{produto_id}/{comanda_id}/{produto_categoria}', [PedidoController::class, 'adicionar']);
Route::get('/pedidos/remover/produto/{produto_id}/{comanda_id}/{produto_categoria}', [PedidoController::class, 'remover']);

//Relatório vendas
Route::get('/relatorio/vendas', [RelatorioController::class, 'acessar']);
Route::get('/relatorio/vendas/{data}', [RelatorioController::class, 'mostrarComandasIndividuais']);












