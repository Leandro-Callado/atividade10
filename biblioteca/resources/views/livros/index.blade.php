@extends('layouts.app')

@section('title', 'Livros | Biblioteca')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Livros</h2>
        <p class="text-muted">Gerencie o acervo da biblioteca.</p>
    </div>

    <a href="{{ route('livros.create') }}" class="btn btn-primary">
        Novo livro
    </a>
</div>

<form action="{{ route('livros.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input
            type="text"
            name="busca"
            class="form-control"
            placeholder="Pesquisar por título ou autor..."
            value="{{ $busca }}"
        >

        <button class="btn btn-dark" type="submit">
            Pesquisar
        </button>
    </div>
</form>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editora</th>
                        <th>ISBN</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($livros as $livro)
                        <tr>
                            <td>{{ $livro->titulo }}</td>
                            <td>{{ $livro->autor }}</td>
                            <td>{{ $livro->editora ?? '-' }}</td>
                            <td>{{ $livro->isbn }}</td>
                            <td>{{ $livro->quantidade }}</td>

                            <td>
                                <a href="{{ route('livros.show', $livro) }}"
                                   class="btn btn-sm btn-outline-secondary">
                                    Ver
                                </a>

                                <a href="{{ route('livros.edit', $livro) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Nenhum livro encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{ $livros->links() }}

    </div>
</div>

@endsection