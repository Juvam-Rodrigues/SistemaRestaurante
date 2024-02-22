<?php

namespace App\Http\Controllers;

use App\Models\Comanda;

use App\Models\Produto;
use Illuminate\Http\Request;

class ComandaController extends Controller
{
    public function criar(Request $request)
    {
        // Validação de entrada
        $request->validate([
            'nome' => 'required|string',
            'mesa_id' => 'required|exists:mesas,id', // Certifique-se de que a mesa_id exista na tabela mesas
        ]);

        // Criação da nova comanda
        Comanda::create([
            'nome' => $request->input('nome'),
            'mesa_id' => $request->input('mesa_id'),
        ]);

        // Redirecionamento ou resposta adequada
        return redirect("/sistema");
    }
    public function apagar($id)
    {
        Comanda::findOrFail($id)->excluirComanda();
        return redirect("/sistema");
    }
    public function acessar($id)
    {
        $comanda = Comanda::find($id);

        if ($comanda != null) {
            $mesa = $comanda->mesa;
            $produtos = Produto::all()->groupBy('categoria');

            // Adicione a lógica para obter os pedidos relacionados à comanda
            $pedidos = $comanda->pedidos;

            return view("comanda/comanda", compact('comanda', 'mesa', 'produtos', 'pedidos'));
        }

        return redirect('/sistema');
    }
    public function pagamento($comanda_id, $metodo_pagamento)
    {


        $comanda = Comanda::findOrFail($comanda_id);

        if (!$comanda->estaPaga() && $comanda->valor != 0) {
            $comanda->pagar($metodo_pagamento);
            session()->flash('msg', ['tipo' => 'sucesso', 'texto' => 'Comanda foi paga com sucesso!']);
            return redirect()->back();
        } else if (!$comanda->estaPaga() && $comanda->valor == 0) {
            session()->flash('msg', ['tipo' => 'erro', 'texto' => 'Adicione produtos na comanda antes de pagá-la!']);
            return redirect()->back();
        } else {
            session()->flash('msg', ['tipo' => 'erro', 'texto' => 'A comanda já foi paga!']);
            return redirect()->back();
        }

    }


}
