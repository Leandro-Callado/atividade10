@extends('layouts.app')

@section('title', 'Detalhes do Empréstimo | Biblioteca')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Detalhes do empréstimo</h2>
        <p class="text-muted">Informações completas do registro.</p>
    </div>

    <a href="{{ route('emprestimos.index') }}"
       class="btn btn-outline-secondary">
        Voltar
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <h5 class="mb-3">Informações do livro</h5>

        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <small class="text-muted">Título</small>
                <p class="fw-semibold mb-0">
                    {{ $emprestimo->livro->titulo }}
                </p>
            </div>

            <div class="col-md-6 mb-3">
                <small class="text-muted">Autor</small>
                <p class="fw-semibold mb-0">
                    {{ $emprestimo->livro->autor }}
                </p>
            </div>
        </div>

        <hr>

        <h5 class="mb-3">Informações do leitor</h5>

        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <small class="text-muted">Nome</small>
                <p class="fw-semibold mb-0">
                    {{ $emprestimo->leitor->nome }}
                </p>
            </div>

            <div class="col-md-6 mb-3">
                <small class="text-muted">CPF</small>
                <p class="fw-semibold mb-0">
                    {{ $emprestimo->leitor->cpf }}
                </p>
            </div>

            <div class="col-md-6 mb-3">
                <small class="text-muted">E-mail</small>
                <p class="fw-semibold mb-0">
                    {{ $emprestimo->leitor->email }}
                </p>
            </div>

            <div class="col-md-6 mb-3">
                <small class="text-muted">Telefone</small>
                <p class="fw-semibold mb-0">
                    {{ $emprestimo->leitor->telefone ?? '-' }}
                </p>
            </div>
        </div>

        <hr>

        <h5 class="mb-3">Informações do empréstimo</h5>

        <div class="row">
            <div class="col-md-4 mb-3">
                <small class="text-muted">Data do empréstimo</small>
                <p class="fw-semibold mb-0">
                    {{ $emprestimo->data_emprestimo->format('d/m/Y') }}
                </p>
            </div>

            <div class="col-md-4 mb-3">
                <small class="text-muted">Devolução prevista</small>
                <p class="fw-semibold mb-0">
                    {{ $emprestimo->data_prevista->format('d/m/Y') }}
                </p>
            </div>

            <div class="col-md-4 mb-3">
                <small class="text-muted">Devolução efetiva</small>
                <p class="fw-semibold mb-0">
                    {{ $emprestimo->data_devolucao
                        ? $emprestimo->data_devolucao->format('d/m/Y')
                        : 'Ainda não devolvido' }}
                </p>
            </div>

            <div class="col-md-4 mb-3">
                <small class="text-muted">Situação</small>
                <p class="mb-0">
                    @if($emprestimo->status === 'Devolvido')
                        <span class="badge bg-success">Devolvido</span>
                    @elseif($emprestimo->data_prevista->format('Y-m-d') < now()->format('Y-m-d'))
                        <span class="badge bg-danger">Atrasado</span>
                    @else
                        <span class="badge bg-warning text-dark">
                            Em andamento
                        </span>
                    @endif
                </p>
            </div>
        </div>

    </div>
</div>

@endsection
