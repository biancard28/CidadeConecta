<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container-fluid">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="CidadeConecta" class="img-fluid me-2" style="height: 45px;">
            <span class="fw-bold">CidadeConecta</span>
        </a>

        <!-- Botão hamburguer -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Conteúdo -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Links -->
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cidades.index') ? 'active' : '' }}"
                        href="{{ route('cidades.index') }}">
                        Cidades
                    </a>
                </li>

            </ul>

            <!-- Busca -->
            <form class="d-flex me-3">
                <input class="form-control me-2" type="search" placeholder="Pesquisar...">
                <button class="btn btn-outline-light" type="submit">
                    🔍
                </button>
            </form>

            <!-- Auth -->
            <ul class="navbar-nav">

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Perfil
                        </a>
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="nav-link btn btn-link text-light" type="submit">
                                Sair
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                            href="{{ route('register') }}">
                            Cadastro
                        </a>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>
