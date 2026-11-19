@extends('layouts.app')

@section('title', 'Leitores | Biblioteca')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Leitores</h2>
        <p class="text-muted">Gerencie os leitores cadastrados na biblioteca.</p>
    </div>

    <a href="{{ route('leitores.create') }}" class="btn btn-primary">
        Novo leitor
    </a>
</div>

<form action="{{ route('leitores.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input
            type="text"
            name="busca"
            class="form-control"
            placeholder="Pesquisar por nome..."
            value="{{ $busca }}"
        >

        <button class="btn btn-dark" type="submit">
            Pesquisar
        </button>

        @if($busca)
            <a href="{{ route('leitores.index') }}" class="btn btn-outline-secondary">
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
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($leitores as $leitor)
                        <tr>
                            <td>{{ $leitor->nome }}</td>
                            <td>{{ $leitor->cpf }}</td>
                            <td>{{ $leitor->email }}</td>
                            <td>{{ $leitor->telefone ?? '-' }}</td>

                            <td>
                                <a href="{{ route('leitores.show', $leitor) }}"
                                   class="btn btn-sm btn-outline-secondary">
                                    Ver
                                </a>

                                <a href="{{ route('leitores.edit', $leitor) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Editar
                                </a>

                                <form
                                    action="{{ route('leitores.destroy', $leitor) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Deseja realmente excluir este leitor?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Nenhum leitor encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{ $leitores->links() }}

    </div>
</div>

@endsection