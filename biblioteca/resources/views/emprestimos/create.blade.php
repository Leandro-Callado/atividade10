@extends('layouts.app')

@section('title', 'Novo Empréstimo | Biblioteca')

@section('content')

<div class="mb-4">
    <h2>Novo empréstimo</h2>
    <p class="text-muted">Registre a retirada de um livro por um leitor.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        @if($livros->isEmpty())
            <div class="alert alert-warning">
                Não existem livros disponíveis no estoque.
                Cadastre livros ou atualize suas quantidades antes de continuar.
            </div>
        @elseif($leitores->isEmpty())
            <div class="alert alert-warning">
                Não existem leitores cadastrados.
                Cadastre um leitor antes de registrar um empréstimo.
            </div>
        @else

            <form action="{{ route('emprestimos.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="livro_id" class="form-label">Livro *</label>

                        <select
                            name="livro_id"
                            id="livro_id"
                            class="form-select @error('livro_id') is-invalid @enderror"
                            required
                        >
                            <option value="">Selecione um livro</option>

                            @foreach($livros as $livro)
                                <option
                                    value="{{ $livro->id }}"
                                    {{ old('livro_id') == $livro->id ? 'selected' : '' }}
                                >
                                    {{ $livro->titulo }} ({{ $livro->quantidade }} disponíveis)
                                </option>
                            @endforeach
                        </select>

                        @error('livro_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="leitor_id" class="form-label">Leitor *</label>

                        <select
                            name="leitor_id"
                            id="leitor_id"
                            class="form-select @error('leitor_id') is-invalid @enderror"
                            required
                        >
                            <option value="">Selecione um leitor</option>

                            @foreach($leitores as $leitor)
                                <option
                                    value="{{ $leitor->id }}"
                                    {{ old('leitor_id') == $leitor->id ? 'selected' : '' }}
                                >
                                    {{ $leitor->nome }}
                                </option>
                            @endforeach
                        </select>

                        @error('leitor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="data_emprestimo" class="form-label">
                            Data do empréstimo *
                        </label>

                        <input
                            type="date"
                            name="data_emprestimo"
                            id="data_emprestimo"
                            class="form-control @error('data_emprestimo') is-invalid @enderror"
                            value="{{ old('data_emprestimo', date('Y-m-d')) }}"
                            required
                        >

                        @error('data_emprestimo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="data_prevista" class="form-label">
                            Data prevista para devolução *
                        </label>

                        <input
                            type="date"
                            name="data_prevista"
                            id="data_prevista"
                            class="form-control @error('data_prevista') is-invalid @enderror"
                            value="{{ old('data_prevista') }}"
                            required
                        >

                        @error('data_prevista')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('emprestimos.index') }}"
                       class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Registrar empréstimo
                    </button>
                </div>

            </form>

        @endif

    </div>
</div>

@endsection
