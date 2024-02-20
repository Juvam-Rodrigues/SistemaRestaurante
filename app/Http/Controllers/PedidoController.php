<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function adicionar($produto_id, $comanda_id)
    {
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
        $listaPedidos = Pedido::where('comanda_id', $comanda_id); //Pega todos os pedidos da tabela pedidos conforme o id de comanda

        return redirect()->back()->with(compact('pedido','listaPedidos'));
        
    }
    


}