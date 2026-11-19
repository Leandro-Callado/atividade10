@extends('layouts.app')

@section('title', 'Novo Leitor | Biblioteca')

@section('content')

<div class="mb-4">
    <h2>Novo leitor</h2>
    <p class="text-muted">Preencha os dados para cadastrar um leitor.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ route('leitores.store') }}" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-md-12">
                    <label for="nome" class="form-label">Nome completo *</label>
                    <input
                        type="text"
                        name="nome"
                        id="nome"
                        class="form-control @error('nome') is-invalid @enderror"
                        value="{{ old('nome') }}"
                        required
                    >
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="cpf" class="form-label">CPF *</label>
                    <input
                        type="text"
                        name="cpf"
                        id="cpf"
                        class="form-control @error('cpf') is-invalid @enderror"
                        placeholder="000.000.000-00"
                        value="{{ old('cpf') }}"
                        required
                    >
                    @error('cpf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail *</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input
                        type="text"
                        name="telefone"
                        id="telefone"
                        class="form-control @error('telefone') is-invalid @enderror"
                        placeholder="(38) 99999-9999"
                        value="{{ old('telefone') }}"
                    >
                    @error('telefone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('leitores.index') }}"
                   class="btn btn-outline-secondary">
                    Cancelar
                </a>

                <button type="submit" class="btn btn-primary">
                    Cadastrar leitor
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
