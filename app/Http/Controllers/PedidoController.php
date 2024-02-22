<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    //Função de acrescentar e remover produtos pela quantidade 
    public function adicionar($produto_id, $comanda_id, $categoria_produto)
    {
        if (!(Comanda::findOrFail($comanda_id)->estaPaga())) {
            // Validação de entrada
            request()->validate([
                'produto_id' => 'exists:produtos,id',
                'comanda_id' => 'exists:comandas,id',
            ]);

            // Obtenha o pedido existente, se houver
            $pedidoExistente = Pedido::where('produto_id', $produto_id)
                ->where('comanda_id', $comanda_id)
                ->first();

            // Determine a quantidade com base no pedido existente
            $quantidade = $pedidoExistente ? $pedidoExistente->quantidade + 1 : 1;

            // Obtenha o valor unitário do produto
            $valor_unitario = Produto::findOrFail($produto_id)->preco;

            // Calcule o valor total do pedido
            $valor_total_pedido = $valor_unitario * $quantidade;

            // Atualize ou crie o pedido
            $pedido = Pedido::updateOrCreate(
                ['produto_id' => $produto_id, 'comanda_id' => $comanda_id],
                ['quantidade' => $quantidade, 'valor_acumulado' => $valor_total_pedido]
            );

            // Atualize o valor acumulado nas linhas anteriores, se existirem
            Pedido::where('produto_id', $produto_id)
                ->where('comanda_id', $comanda_id)
                ->where('id', '<', $pedido->id) // exclua o pedido atual da atualização
                ->update(['valor_acumulado' => \DB::raw('valor_acumulado + ' . $valor_total_pedido)]);


            // Redirecionamento ou resposta adequada
            $listaPedidos = Pedido::where('comanda_id', $comanda_id)->with('produto')->get();

            //Atualizar o valor da comanda
            Comanda::findOrFail($comanda_id)->acumularValor($listaPedidos);

            // Buscar produtos comuns por categoria no banco de dados
            $produtosPorCategoria = DB::table('produtos')
                ->where('categoria', $categoria_produto)
                ->get();


            return redirect()->back()->with('listaPedidos', $listaPedidos)->with('produtosPorCategoria', $produtosPorCategoria);
        } else {
            session()->flash('msg', ['tipo' => 'erro', 'texto' => 'Você não pode alterar uma comanda já paga! Por favor, crie outra.']);
            return back();
        }
    }


    public function remover($produto_id, $comanda_id, $categoria_produto)
    {
        if (!(Comanda::findOrFail($comanda_id)->estaPaga())) {
            request()->validate([
                'produto_id' => 'exists:produtos,id',
                'comanda_id' => 'exists:comandas,id',
            ]);

            // Obtenha o pedido existente, se houver
            $pedidoExistente = Pedido::where('produto_id', $produto_id)
                ->where('comanda_id', $comanda_id)
                ->first();

            // Determine a quantidade com base no pedido existente
            $quantidade = $pedidoExistente ? $pedidoExistente->quantidade - 1 : 1;

            // Obtenha o valor unitário do produto
            $valor_unitario = Produto::findOrFail($produto_id)->preco;

            // Calcule o valor total do pedido
            $valor_total_pedido = $valor_unitario * $quantidade;

            // Atualize ou crie o pedido
            $pedido = Pedido::updateOrCreate(
                ['produto_id' => $produto_id, 'comanda_id' => $comanda_id],
                ['quantidade' => $quantidade, 'valor_acumulado' => $valor_total_pedido]
            );

            // Atualize o valor acumulado nas linhas anteriores, se existirem
            Pedido::where('produto_id', $produto_id)
                ->where('comanda_id', $comanda_id)
                ->where('id', '<', $pedido->id) // exclua o pedido atual da atualização
                ->update(['valor_acumulado' => \DB::raw('valor_acumulado + ' . $valor_total_pedido)]);

            if ($pedido->valor_acumulado <= 0) {
                $pedido->excluirPedido();
            }
            //Retornando para ficar aparecendo na view
            $listaPedidos = Pedido::where('comanda_id', $comanda_id)->with('produto')->get();

            //Atualizar o valor da comanda
            Comanda::findOrFail($comanda_id)->acumularValor($listaPedidos);

            $produtosPorCategoria = DB::table('produtos')
                ->where('categoria', $categoria_produto)
                ->get();

            return redirect()->back()->with('listaPedidos', $listaPedidos)->with('produtosPorCategoria', $produtosPorCategoria);
        } else {
            session()->flash('msg', ['tipo' => 'erro', 'texto' => 'Você não pode alterar uma comanda já paga! Por favor, crie outra.']);
            return back();
        }

    }


}