<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function criar(Request $request)
    {

        // Validação de entrada
        $request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'categoria' => 'nullable|string',
        ]);


        // Criação de novo produto
        Produto::create([
            'nome' => $request->input('nome'),
            'descricao' => $request->input('descricao'),
            'preco' => $request->input('preco'),
            'categoria' => $request->input('categoria'),
        ]);


        // Redirecionamento ou resposta adequada
        return back()->with('success', 'Produto adicionado com sucesso!');
        //Rediriciona para a página anterior (no caso, página atual) após a operação ser concluída com sucesso.

    }
    public function listarProdutos(Request $request)
    {
        $categoria = $request->query('categoria');
        $produtosPorCategoria = Produto::where('categoria', $categoria)->get();

        return redirect()->back()->with('produtosPorCategoria', $produtosPorCategoria);
    }

}