@extends('layouts.app')

@section('title', 'Dashboard | Biblioteca')

@section('content')

<h2 class="mb-2">Dashboard</h2>
<p class="text-muted mb-4">
    Visão geral do gerenciamento da biblioteca.
</p>

<div class="row g-4">

    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total de livros</h6>
                <h2>{{ $totalLivros }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total de leitores</h6>
                <h2>{{ $totalLeitores }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Empréstimos ativos</h6>
                <h2>{{ $emprestimosAtivos }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Empréstimos atrasados</h6>
                <h2 class="text-danger">{{ $emprestimosAtrasados }}</h2>
            </div>
        </div>
    </div>

</div>

@endsection
