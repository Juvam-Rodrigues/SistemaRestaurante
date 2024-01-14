<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'email', 'senha'];
    protected $hidden = ['senha'];

    public static function criarUsuario($nome, $senha, $repetirSenha, $email)
    {
        if ($senha == $repetirSenha) {
            // Criptografar a senha usando Hash::make
            $senhaCriptografada = Hash::make($senha);
    
            $usuario = new Usuario([
                'nome' => $nome,
                'senha' => $senhaCriptografada,
                'email' => $email
            ]);
    
            $usuario->save();
            return $usuario;
        }
    
        return null;
    }

    public static function logar($email, $senha){
        $usuario = Usuario::where('email', $email)->first();

        if($usuario != null && Hash::check($senha, $usuario->senha)){ //Check verifica
            session()->put('usuario', $usuario); //Variável de sessão para que ela não seja morta ao apagar a página, para que a aplicação não se esqueça.
            return true;
        }
        return false;
        
    }
    public function deslogar(){
        session()->forget('usuario');
    }

    // DADOS

    public function editarDados($nome, $email, $senha){
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->save(); //Salva no banco de dados.
    }
    
   
}
