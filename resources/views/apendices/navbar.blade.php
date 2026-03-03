<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="CidadeConect" class="img-fluid me-2" style="height: 45px;">
            <span class="fw-bold">CidadeConect</span>
        </a>

        <!-- Botão hamburguer para mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Conteúdo da navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Links principais -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cidade.index') ? 'active' : '' }}"
                        href="{{ route('cidade.index') }}">
                        Cidades
                    </a>
                </li>
            </ul>

            <!-- Barra de pesquisa -->
            <form class="d-flex me-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Pesquisar..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <!-- Links de login/logout -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}"
                            href="{{ route('profile') }}">
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
