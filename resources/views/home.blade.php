<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cidade Conecta</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #fff;
            color: #202124;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            font-size: 14px;
            border-bottom: 1px solid #dadce0;
        }

        .cidade-atual {
            font-weight: bold;
        }

        .top-menu a,
        .top-menu button {
            margin-left: 20px;
            text-decoration: none;
            color: #202124;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .top-menu a:hover,
        .top-menu button:hover {
            text-decoration: underline;
        }

        .logo {
            text-align: center;
            margin-top: 60px;
        }

        .logo h1 {
            font-size: 42px;
        }

        .search-box {
            text-align: center;
            margin-top: 25px;
            position: relative;
        }

        .search-box input {
            width: 400px;
            max-width: 80%;
            padding: 12px 20px;
            border-radius: 24px;
            border: 1px solid #dadce0;
            font-size: 16px;
        }

        .search-box button {
            margin-top: 15px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background: #f8f9fa;
            cursor: pointer;
        }

        .container {
            text-align: center;
            margin-top: 20px;
            flex: 1;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #5f6368;
            border-top: 1px solid #dadce0;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #dadce0;
            border-top: none;
            z-index: 99;
            background: #fff;
            width: 400px;
            max-width: 80%;
            left: 50%;
            transform: translateX(-50%);
        }

        .autocomplete-item {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }

        .autocomplete-item:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>

    <!-- TOPO -->
    <div class="top-bar">
        <div class="cidade-atual">
            @if (isset($cidadeAtual))
                Você está em: {{ $cidadeAtual }}
            @else
                Você está em: Não identificado
            @endif
        </div>

        <div class="top-menu">
            @auth
                <a href="#">Perfil</a>

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            @else
                <a href="/login">Login</a>
                <a href="/register">Cadastrar</a>
            @endauth
        </div>
    </div>

    <!-- LOGO -->
    <div class="logo">
        <h1>Cidade Conecta</h1>
    </div>

    <!-- BUSCA -->
    <div class="search-box">
        <form action="/buscar" method="GET">
            <input type="text" id="cidadeInput" name="q" placeholder="Digite a sua cidade" autofocus>
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
        <p>Segunda a sexta, 08h às 17h</p>
    </div>

    <!-- SCRIPT AUTOCOMPLETE -->
    <script>
        const input = document.getElementById("cidadeInput");
        const autocompleteList = document.getElementById("autocomplete-list");

        let debounceTimer;

        input.addEventListener("input", function() {
            const val = this.value;

            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(() => {
                autocompleteList.innerHTML = "";

                if (!val) return;

                fetch(`/cidades/autocomplete?q=${encodeURIComponent(val)}`)
                    .then(response => response.json())
                    .then(cidades => {
                        cidades.forEach(cidade => {
                            const item = document.createElement("div");
                            item.classList.add("autocomplete-item");
                            item.innerHTML =
                                `<strong>${cidade.substr(0, val.length)}</strong>${cidade.substr(val.length)}`;
                            item.addEventListener("click", () => {
                                input.value = cidade;
                                autocompleteList.innerHTML = "";
                            });
                            autocompleteList.appendChild(item);
                        });
                    });
            }, 300);
        });

        document.addEventListener("click", function(e) {
            if (e.target !== input) {
                autocompleteList.innerHTML = "";
            }
        });
    </script>

</body>
</html>
