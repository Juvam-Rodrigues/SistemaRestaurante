<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = ['comanda_id', 'produto_id', 'quantidade', 'valor_unitario'];


    //Relacionamento
    public function comanda()
    {
        return $this->belongsTo(Comanda::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

}
