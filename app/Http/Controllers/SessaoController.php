<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class SessaoController extends Controller
{
    public function new() {
        return view("sessoes/login");
    }

    public function create(Request $r) {
        $email = $r->email;
        $senha = $r->senha;
        
        $comparacao = Usuario::logar($email, $senha);

        if($comparacao==true){
            return redirect("/sistema");
        }else{
            return redirect("/")->with('mensagem', 'Insira os dados corretamente ou crie uma conta.');;
        }

    }
    public function back(){
        session()->get('usuario')->deslogar();
        return redirect("/");
    }
}
