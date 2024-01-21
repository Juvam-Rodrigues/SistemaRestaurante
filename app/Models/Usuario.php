<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Usuario extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'email', 'senha'];

    public static function logar($email, $senha){
        $usuario = Usuario::where('email', $email)->first();

        if($usuario != null && $senha === $usuario->senha){ 
            session()->put('usuario', $usuario); //Variável de sessão para que ela não seja morta ao apagar a página, para que a aplicação não se esqueça.
            return true;
        }
        return false;
        
    }
    public function deslogar()
    {
        session()->forget('usuario');
    }

    // DADOS

    public function editarDados($nome, $email, $senha)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->save(); //Salva no banco de dados.
    }

    //Relacionamento um para muitos com mesas
    public function mesas(): HasMany
    {
        return $this->hasMany(Mesa::class);
    }
    public function criarMesas($numero){
        $mesa = new Mesa(['numero' => $numero]);
        $this->mesas()->save($mesa);
    }
}
