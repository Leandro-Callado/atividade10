@extends('layouts.app')

@section('title', 'Novo Livro | Biblioteca')

@section('content')

<div class="mb-4">
    <h2>Novo livro</h2>
    <p class="text-muted">Preencha os dados para cadastrar um livro no acervo.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ route('livros.store') }}" method="POST">

            @csrf

            <div class="row g-3">

                <div class="col-md-8">
                    <label for="titulo" class="form-label">Título *</label>
                    <input
                        type="text"
                        name="titulo"
                        id="titulo"
                        class="form-control @error('titulo') is-invalid @enderror"
                        value="{{ old('titulo') }}"
                        required
                    >
                    @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="isbn" class="form-label">ISBN *</label>
                    <input
                        type="text"
                        name="isbn"
                        id="isbn"
                        class="form-control @error('isbn') is-invalid @enderror"
                        value="{{ old('isbn') }}"
                        required
                    >
                    @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="autor" class="form-label">Autor *</label>
                    <input
                        type="text"
                        name="autor"
                        id="autor"
                        class="form-control @error('autor') is-invalid @enderror"
                        value="{{ old('autor') }}"
                        required
                    >
                    @error('autor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="editora" class="form-label">Editora</label>
                    <input
                        type="text"
                        name="editora"
                        id="editora"
                        class="form-control @error('editora') is-invalid @enderror"
                        value="{{ old('editora') }}"
                    >
                    @error('editora')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="ano_publicacao" class="form-label">Ano de publicação</label>
                    <input
                        type="number"
                        name="ano_publicacao"
                        id="ano_publicacao"
                        class="form-control @error('ano_publicacao') is-invalid @enderror"
                        value="{{ old('ano_publicacao') }}"
                        min="1000"
                        max="{{ date('Y') }}"
                    >
                    @error('ano_publicacao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="quantidade" class="form-label">Quantidade *</label>
                    <input
                        type="number"
                        name="quantidade"
                        id="quantidade"
                        class="form-control @error('quantidade') is-invalid @enderror"
                        value="{{ old('quantidade', 1) }}"
                        min="0"
                        required
                    >
                    @error('quantidade')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary">
                    Cancelar
                </a>

                <button type="submit" class="btn btn-primary">
                    Cadastrar livro
                </button>
            </div>

        </form>

    </div>
</div>

@endsection