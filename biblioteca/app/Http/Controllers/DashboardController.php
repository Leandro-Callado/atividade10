<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Leitor;
use App\Models\Emprestimo;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLivros = Livro::count();

        $totalLeitores = Leitor::count();

        $emprestimosAtivos = Emprestimo::where(
            'status',
            'Em andamento'
        )->count();

        $emprestimosAtrasados = Emprestimo::where(
            'status',
            'Em andamento'
        )
        ->whereDate('data_prevista', '<', now()->toDateString())
        ->count();

        return view('dashboard', compact(
            'totalLivros',
            'totalLeitores',
            'emprestimosAtivos',
            'emprestimosAtrasados'
        ));
    }
}
