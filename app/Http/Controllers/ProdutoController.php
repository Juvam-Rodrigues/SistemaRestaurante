<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
    
    public function listarPorCategoria($categoria)
    {
        // Buscar produtos comuns por categoria no banco de dados
        $produtosPorCategoria = DB::table('produtos')
            ->where('categoria', $categoria)
            ->get();

        // Passar os produtos para a view
        return back()->with('produtosPorCategoria', $produtosPorCategoria);    
    }

}