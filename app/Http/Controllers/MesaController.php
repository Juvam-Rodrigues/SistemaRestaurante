<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function criar(Request $request){
        $numero = $request->numero;
        $nova = session()->get('usuario')->criarMesas($numero);
        return redirect("/sistema");
    }
    public function apagar($id){
        Mesa::findOrFail($id)->excluirMesa();
        return redirect("/sistema");
    }
}
