<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RelatorioController extends Controller
{
    public function acessar(){
        $comandas_guardadas = DB::table('comandas')->where('pode_guardar', 1);
        return view('relatorio/vendas');
    }
}
