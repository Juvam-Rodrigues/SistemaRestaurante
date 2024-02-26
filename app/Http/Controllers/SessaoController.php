<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class SessaoController extends Controller
{
    public function nova() {
        return view("sessoes/login");
    }

    public function criar(Request $r) {
        $email = $r->email;
        $senha = $r->senha;
        
        $comparacao = Usuario::logar($email, $senha);

        if($comparacao){
            return redirect("/sistema");

        }else{
            session()->flash('msg', ['tipo' => 'erro', 'texto' => 'Coloque seus dados corretamente.']);
            return redirect("/");
        }

    }
    public function voltar(){
        session()->get('usuario')->deslogar();
        return redirect("/");
    }
}
