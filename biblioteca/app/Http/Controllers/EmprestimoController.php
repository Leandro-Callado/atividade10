<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Leitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmprestimoController extends Controller
{
    /**
     * Lista os empréstimos.
     */
    public function index(Request $request)
    {
        $busca = $request->input('situacao');

        $emprestimos = Emprestimo::with(['livro', 'leitor'])
            ->when($busca, function ($query, $busca) {
                $query->where('status', $busca);
            })
            ->orderByDesc('data_emprestimo')
            ->paginate(10)
            ->withQueryString();

        return view('emprestimos.index', compact('emprestimos', 'busca'));
    }

    /**
     * Exibe o formulário de novo empréstimo.
     */
    public function create()
    {
        $livros = Livro::where('quantidade', '>', 0)
            ->orderBy('titulo')
            ->get();

        $leitores = Leitor::orderBy('nome')->get();

        return view('emprestimos.create', compact('livros', 'leitores'));
    }

    /**
     * Registra um novo empréstimo.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'livro_id' => ['required', 'exists:livros,id'],
            'leitor_id' => ['required', 'exists:leitores,id'],
            'data_emprestimo' => ['required', 'date'],
            'data_prevista' => [
                'required',
                'date',
                'after_or_equal:data_emprestimo',
            ],
        ]);

        DB::transaction(function () use ($dados) {
            $livro = Livro::whereKey($dados['livro_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($livro->quantidade < 1) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'livro_id' => 'Não há exemplares disponíveis deste livro.',
                ]);
            }

            $livro->decrement('quantidade');

            Emprestimo::create([
                'livro_id' => $dados['livro_id'],
                'leitor_id' => $dados['leitor_id'],
                'data_emprestimo' => $dados['data_emprestimo'],
                'data_prevista' => $dados['data_prevista'],
                'status' => 'Em andamento',
            ]);
        });

        return redirect()
            ->route('emprestimos.index')
            ->with('sucesso', 'Empréstimo registrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um empréstimo.
     */
    public function show(Emprestimo $emprestimo)
    {
        $emprestimo->load(['livro', 'leitor']);

        return view('emprestimos.show', compact('emprestimo'));
    }
}
