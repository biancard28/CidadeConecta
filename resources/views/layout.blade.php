<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cidade Conecta</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f1f5f9;
        }

        .navbar {
            background-color: #15803d !important;
        }

        .navbar-brand {
            font-weight: bold;
        }

        /* 🔥 SIDEBAR BONITA */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #15803d, #166534);
            position: fixed;
            top: 0;
            left: -260px; /* 🔥 começa escondida */
            padding-top: 70px;
            transition: 0.3s;
            color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .sidebar.active {
            left: 0; /* aparece */
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            transition: 0.2s;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            border-left: 4px solid #22c55e;
            padding-left: 25px;
        }

        .sidebar hr {
            border-color: rgba(255,255,255,0.2);
        }

        /* CONTEÚDO */
        .content {
            transition: 0.3s;
            padding: 20px;
        }

        /* BOTÃO MENU */
        .menu-btn {
            font-size: 22px;
            cursor: pointer;
            color: white;
            margin-right: 15px;
        }

        /* OVERLAY ESCURO */
        .overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            top: 0;
            left: 0;
            display: none;
            z-index: 900;
        }

        .overlay.active {
            display: block;
        }

        .card {
            border-radius: 12px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">

        <!-- BOTÃO 3 RISQUINHOS -->
        <span class="menu-btn" onclick="toggleSidebar()">☰</span>

        <a class="navbar-brand" href="/">CidadeConecta</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cidades.index') }}">Cidades</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sair</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<!-- OVERLAY -->
<div id="overlay" class="overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">

    <a href="{{ isset($cidade) ? route('site.agenda_municipal', $cidade->id) : '#' }}">
        Geral
    </a>

    @isset($categorias)
        @foreach($categorias as $categoria)
            <a href="{{ route('site.agenda_municipal', $cidade->id) }}?categoria={{ $categoria->id }}">
                {{ $categoria->nome }}
            </a>
        @endforeach
    @endisset

    <hr>

    <a href="#">
        Saiba mais
    </a>

</div>

<!-- CONTEÚDO -->
<div class="content">
    <div class="container mt-4">
        @yield('conteudo')
    </div>
</div>

<!-- JS -->
<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");
        document.getElementById("overlay").classList.toggle("active");
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
