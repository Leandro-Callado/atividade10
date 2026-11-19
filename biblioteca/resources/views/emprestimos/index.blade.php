@extends('layouts.app')

@section('title', 'Empréstimos | Biblioteca')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Empréstimos</h2>
        <p class="text-muted">Gerencie os empréstimos da biblioteca.</p>
    </div>

    <a href="{{ route('emprestimos.create') }}" class="btn btn-primary">
        Novo empréstimo
    </a>
</div>

<form action="{{ route('emprestimos.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        
<select name="situacao" class="form-select">
    <option value="">Todas as situações</option>

    <option value="Em andamento"
        @selected($situacao === 'Em andamento')>
        Em andamento
    </option>

    <option value="Devolvido"
        @selected($situacao === 'Devolvido')>
        Devolvido
    </option>

    <option value="atrasados"
        @selected($situacao === 'atrasados')>
        Atrasados
    </option>
</select>

        <button type="submit" class="btn btn-dark">
            Filtrar
        </button>

        @if($busca)
            <a href="{{ route('emprestimos.index') }}"
               class="btn btn-outline-secondary">
                Limpar
            </a>
        @endif
    </div>
</form>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Livro</th>
                        <th>Leitor</th>
                        <th>Empréstimo</th>
                        <th>Devolução prevista</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($emprestimos as $emprestimo)
                        <tr>
                            <td>{{ $emprestimo->livro->titulo }}</td>
                            <td>{{ $emprestimo->leitor->nome }}</td>
                            <td>{{ $emprestimo->data_emprestimo->format('d/m/Y') }}</td>
                            <td>{{ $emprestimo->data_prevista->format('d/m/Y') }}</td>

                            <td>
                                @if($emprestimo->status === 'Devolvido')
                                    <span class="badge bg-success">
                                        Devolvido
                                    </span>
                                @elseif($emprestimo->data_prevista->isPast() &&
                                    $emprestimo->data_prevista->format('Y-m-d') < now()->format('Y-m-d'))
                                    <span class="badge bg-danger">
                                        Atrasado
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Em andamento
                                    </span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('emprestimos.show', $emprestimo) }}"
                                   class="btn btn-sm btn-outline-secondary">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Nenhum empréstimo cadastrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{ $emprestimos->links() }}

    </div>
</div>

@endsection
