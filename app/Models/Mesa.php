<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Mesa extends Model
{
    use HasFactory;
    protected $fillable = ['numero'];




    

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
