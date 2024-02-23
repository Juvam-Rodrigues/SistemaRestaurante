<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'status', 'valor', 'mesa_id', 'tipo_pagamento', 'desconto'];


    public function excluirComanda()
    {
        $this->mesa()->dissociate(); //Remove a mesa do usuário, a desassociando mesa de usuário.
        $this->pedidos()->delete();    // Remover pedidos associados, apagando.
        $this->delete();
    }

    //Alterando o valor da comanda
    public function acumularValor($listaPedidos)
    {
        $this->valor = 0;
        foreach ($listaPedidos as $pedido) {
            $this->valor += $pedido->valor_acumulado;
        }
        $this->save();
    }

    //Pagar
    public function pagar($metodo_pagamento, $desconto)
    {
        $this->valor = $this->valor - $desconto;
        $this->tipo_pagamento = $metodo_pagamento;
        $this->status = $this->status + 1;
        $this->desconto = $desconto;
        $this->save();
    }

    public function estaPaga()
    {
        // Se o status for igual a 1, consideramos a comanda como paga.
        return $this->status === 1;
    }

    // Relacionamento muitas comandas para uma mesa
    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }
    // Relacionamento muitas pedidos para uma comanda

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

}
