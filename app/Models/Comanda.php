<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'status', 'valor'];

    //Relacionamento um para muitos com mesa
    public function mesa(){
        return $this->belongsTo(Mesa::class);
    }
}
