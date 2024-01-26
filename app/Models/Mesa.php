<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Mesa extends Model
{
    use HasFactory;
    protected $fillable = ['numero'];

    public function excluirMesa(){
        $this->usuario()->dissociate(); //Remove a mesa do usuário, a desassociando mesa de usuário.
        $this->delete();
    }
    

    //Relacionamento um para muitos com comandas
    public function comandas(): HasMany
    {
        return $this->hasMany(Comanda::class);
    }
    //Relacionamento um para muitos com usuário

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

}
