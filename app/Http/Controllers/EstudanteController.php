<?php

namespace App\Http\Controllers;

use App\Models\Estudante;

class EstudanteController extends Controller
{
    public function index()
    {
        $estudantes = Estudante::all();
        return view('dashboard.estudantes.index', compact('estudantes'));
    }

    public function showRendimentos($num_matricula)
    {
        // Recupera o estudante pelo num_matricula e carrega seus rendimentos
        $estudante = Estudante::with('rendimentos')->where('num_matricula', $num_matricula)->first();

        // Caso o estudante não seja encontrado
        if (!$estudante) {
            return redirect()->route('estudante.list')->with('error', 'Estudante não encontrado.');
        }

        return view('estudantes.rendimentos', compact('estudante'));
    }
}
