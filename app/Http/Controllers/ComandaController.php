<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use Illuminate\Http\Request;

class ComandaController extends Controller
{
    public function criar(Request $request)
    {
        // Validação de entrada
        $request->validate([
            'nome' => 'required|string',
            'mesa_id' => 'required|exists:mesas,id', // Certifique-se de que a mesa_id exista na tabela mesas
        ]);

        // Criação da nova comanda
        Comanda::create([
            'nome' => $request->input('nome'),
            'mesa_id' => $request->input('mesa_id'),
        ]);

        // Redirecionamento ou resposta adequada
        return redirect("/sistema");
    }
    public function apagar($id)
    {
        Comanda::findOrFail($id)->excluirComanda();
        return redirect("/sistema");
    }


}
