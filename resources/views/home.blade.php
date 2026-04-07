<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cidade Conecta</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f8f9fa;
            color: #202124;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* TOPO */
        .top-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 15px 25px;
            background: #fff;
            border-bottom: 1px solid #dadce0;
        }

        .top-menu {
            display: flex;
            align-items: center;
        }

        .top-menu a,
        .top-menu button {
            font-size: 14px;
            cursor: pointer;
            border: none;
            text-decoration: none;
            margin-left: 10px;
        }

        /* LOGIN */
        .login-link {
            color: #1a73e8;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        /* BOTÃO CADASTRO AZUL */
        .btn-register {
            display: inline-block;
            background: #007bff;
            color: #fff !important;
            padding: 8px 18px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-register:hover {
            background: #0056b3;
        }

        /* LOGADO */
        .separator {
            margin: 0 10px;
            color: #999;
        }

        .top-menu a:hover,
        .top-menu button:hover {
            text-decoration: underline;
        }

        /* LOGO */
        .logo {
            text-align: center;
            margin-top: 80px;
        }

        .logo h1 {
            font-size: 48px;
            color: #1a73e8;
        }

        .logo p {
            color: #5f6368;
            font-size: 18px;
        }

        /* BUSCA */
        .search-box {
            text-align: center;
            margin-top: 30px;
            position: relative;
        }

        .search-box input {
            width: 450px;
            max-width: 85%;
            padding: 14px 20px;
            border-radius: 30px;
            border: 1px solid #dadce0;
            font-size: 16px;
            outline: none;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
        }

        .search-box input:focus {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .search-box button {
            margin-top: 20px;
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            background: #1a73e8;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        .search-box button:hover {
            background: #1669c1;
        }

        /* CONTEÚDO */
        .container {
            text-align: center;
            margin-top: 30px;
            flex: 1;
        }

        /* RODAPÉ */
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #5f6368;
            border-top: 1px solid #dadce0;
            background: #fff;
        }

        /* AUTOCOMPLETE */
        .autocomplete-items {
            position: absolute;
            border: 1px solid #dadce0;
            background: #fff;
            width: 450px;
            max-width: 85%;
            left: 50%;
            transform: translateX(-50%);
        }

        .autocomplete-item {
            padding: 10px;
            cursor: pointer;
        }

        .autocomplete-item:hover {
            background: #f1f1f1;
        }
    </style>
</head>

<body>

    <!-- TOPO -->
    <div class="top-bar">
        <div class="top-menu">
            @auth
                <a href="#">Perfil</a>
                <span class="separator">|</span>
                <a href="/cidades">Cidades</a>
                <span class="separator">|</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            @else
                <a href="/login" class="login-link">Entrar</a>
                <a href="/register" class="btn-register">Criar conta</a>
            @endauth
        </div>
    </div>

    <!-- LOGO -->
    <div class="logo">
        <h1>Cidade Conecta</h1>
        <p>Encontre informações da sua cidade de forma rápida</p>
    </div>

    <!-- BUSCA -->
    <div class="search-box">
        <form action="/buscar" method="GET">
            <input type="text" id="cidadeInput" name="q" placeholder="Digite sua cidade..." autofocus>
            <div id="autocomplete-list" class="autocomplete-items"></div>
            <br>
            <button type="submit">Buscar</button>
        </form>
    </div>

    <!-- CONTEÚDO -->
    <div class="container">
        @yield('conteudo')
    </div>

    <!-- RODAPÉ -->
    <div class="footer">
        <p>Prefeitura de Cidade Conecta</p>
        <p>📞 (00) 1234-5678 | ✉️ contato@cidadeconecta.gov.br</p>
    </div>

</body>
</html>
