<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SistemaController extends Controller
{
    public function exibir(){
        return view("sistema/index");
    }
    public function exibirSobreNos(){
        return view("sistema/sobreNos");
    }
}
