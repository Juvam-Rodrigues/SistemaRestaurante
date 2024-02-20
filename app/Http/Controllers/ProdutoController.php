<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Pedido;

use Exception;
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
        session()->flash('msg', ['tipo' => 'sucesso', 'texto' => 'Produto adicionado com sucesso!']);
        return back();
        //Rediriciona para a página anterior (no caso, página atual) após a operação ser concluída com sucesso.

    }

    public function apagar($id)
    {
        try{
            Produto::findOrFail($id)->excluirProduto();
            session()->flash('msg', ['tipo' => 'sucesso', 'texto' => 'Produto apagado com sucesso!']);
            return back();
        }
        catch(Exception $excecao){
            session()->flash('msg', ['tipo' => 'erro', 'texto' => 'Produto não apagado, pois ele deve ser apagado nos pedidos.']);
            return back();
        }
    }
    
    public function listarPorCategoria($comanda_id, $categoria)
    {
        // Buscar produtos comuns por categoria no banco de dados
        $produtosPorCategoria = DB::table('produtos')
            ->where('categoria', $categoria)
            ->get();

        $listaPedidos = Pedido::where('comanda_id', $comanda_id)->with('produto')->get();

        // Passar os produtos para a view
        return back()->with('produtosPorCategoria', $produtosPorCategoria)->with('listaPedidos', $listaPedidos);    
    }

}