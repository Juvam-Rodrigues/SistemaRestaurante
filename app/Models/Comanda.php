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
