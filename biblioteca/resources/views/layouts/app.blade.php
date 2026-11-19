<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistema Biblioteca')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f4f6f9;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #212529;
        }

        .sidebar a {
            display: block;
            padding: 12px 18px;
            color: #adb5bd;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #343a40;
            color: #fff;
        }

        .main-content {
            min-width: 0;
            flex: 1;
        }

        .content {
            padding: 30px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .content {
                padding: 18px;
            }
        }
    </style>
</head>
<body>

<div class="d-flex flex-column flex-md-row">

    <aside class="sidebar p-3">

        <h4 class="text-white mb-4">
            <i class="bi bi-book"></i>
            Biblioteca
        </h4>

        <nav>
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('livros.index') }}"
               class="{{ request()->routeIs('livros.*') ? 'active' : '' }}">
                Livros
            </a>

            <a href="{{ route('leitores.index') }}"
               class="{{ request()->routeIs('leitores.*') ? 'active' : '' }}">
                Leitores
            </a>

            <a href="{{ route('emprestimos.index') }}"
               class="{{ request()->routeIs('emprestimos.*') ? 'active' : '' }}">
                Empréstimos
            </a>
        </nav>

    </aside>

    <main class="main-content">

        <header class="bg-white border-bottom p-3">
            <strong>Sistema de Gerenciamento de Biblioteca</strong>
        </header>

        <section class="content">

            @if(session('sucesso'))
                <div class="alert alert-success">
                    {{ session('sucesso') }}
                </div>
            @endif

            @if(session('erro'))
                <div class="alert alert-danger">
                    {{ session('erro') }}
                </div>
            @endif

            @yield('content')

        </section>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
