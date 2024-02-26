<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RelatorioController extends Controller
{
    public function acessar()
    {
        $comandas_por_data = DB::table('comandas')
            ->where('pode_guardar', 1)
            ->select(
                DB::raw('DATE(updated_at) as data'),
                DB::raw('SUM(valor) as valor_total')
            )
            ->groupBy(DB::raw('DATE(updated_at)'))
            ->get();

        $valor_acumulado = 0;
        $comandas_acumuladas = [];

        foreach ($comandas_por_data as $comanda) {
            $valor_acumulado += $comanda->valor_total;
            $comandas_acumuladas[] = ['data' => $comanda->data, 'valor_acumulado' => $valor_acumulado];
        }

        return view('relatorio/vendas', compact('comandas_acumuladas'));
    }
    public function mostrarComandasIndividuais($data){
        $comandas = DB::table('comandas')
        ->where('pode_guardar', 1)
        ->whereDate('updated_at', $data)
        ->get();
        return view('relatorio/vendasDoDia', compact('comandas'));
    }
}
