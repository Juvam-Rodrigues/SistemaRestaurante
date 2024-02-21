<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'status', 'valor', 'mesa_id'];


    public function excluirComanda()
    {
        $this->mesa()->dissociate(); //Remove a mesa do usuário, a desassociando mesa de usuário.
        $this->pedidos()->delete();    // Remover pedidos associados, apagando.
        $this->delete();
    }

    public function acumularValor($listaPedidos){
        $this->valor = 0;
        foreach($listaPedidos as $pedido){              
            $this->valor+=$pedido->valor_acumulado;
        }
        $this->save();
    }
    public function diminuitValor($listaPedidos){
        $this->valor = 0;
        foreach($listaPedidos as $pedido){              
            $this->valor-=$pedido->valor_acumulado;
        }
        $this->save();
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
