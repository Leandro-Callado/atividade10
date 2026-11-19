<?php

namespace App\Http\Controllers;

use App\Models\Leitor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeitorController extends Controller
{
    /**
     * Lista os leitores cadastrados.
     */
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $leitores = Leitor::query()
            ->when($busca, function ($query, $busca) {
                $query->where('nome', 'like', "%{$busca}%");
            })
            ->orderBy('nome')
            ->paginate(10)
            ->withQueryString();

        return view('leitores.index', compact('leitores', 'busca'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        return view('leitores.create');
    }

    /**
     * Cadastra um novo leitor.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:14', 'unique:leitores,cpf'],
            'email' => ['required', 'email', 'max:255', 'unique:leitores,email'],
            'telefone' => ['nullable', 'string', 'max:20'],
        ]);

        Leitor::create($dados);

        return redirect()
            ->route('leitores.index')
            ->with('sucesso', 'Leitor cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um leitor.
     */
    public function show(Leitor $leitore)
    {
        $leitore->load('emprestimos.livro');

        return view('leitores.show', ['leitor' => $leitore]);
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Leitor $leitore)
    {
        return view('leitores.edit', ['leitor' => $leitore]);
    }

    /**
     * Atualiza os dados do leitor.
     */
    public function update(Request $request, Leitor $leitore)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => [
                'required',
                'string',
                'max:14',
                Rule::unique('leitores', 'cpf')->ignore($leitore->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('leitores', 'email')->ignore($leitore->id),
            ],
            'telefone' => ['nullable', 'string', 'max:20'],
        ]);

        $leitore->update($dados);

        return redirect()
            ->route('leitores.index')
            ->with('sucesso', 'Leitor atualizado com sucesso!');
    }

    /**
     * Exclui um leitor.
     */
    public function destroy(Leitor $leitore)
    {
        if ($leitore->emprestimos()->exists()) {
            return redirect()
                ->route('leitores.index')
                ->with('erro', 'Não é possível excluir um leitor com histórico de empréstimos.');
        }

        $leitore->delete();

        return redirect()
            ->route('leitores.index')
            ->with('sucesso', 'Leitor excluído com sucesso!');
    }
}
