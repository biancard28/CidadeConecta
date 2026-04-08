<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Cidade Conecta')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --verde:       #1e7d5a;
            --verde-light: #28a874;
            --verde-xlight:#e8f5f0;
            --azul:        #1a4fa0;
            --cinza-bg:    #f4f6f8;
            --cinza-borda: #d8dde6;
            --texto:       #1c2230;
            --texto-suave: #5a6272;
            --branco:      #ffffff;
            --radius:      12px;
            --shadow:      0 4px 20px rgba(0,0,0,0.08);
        }

        html, body {
            min-height: 100vh;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cinza-bg);
            color: var(--texto);
            display: flex;
            flex-direction: column;
        }

        /* ── TOPO ───────────────────────────────────────────── */
        .top-bar {
            background: var(--branco);
            border-bottom: 1px solid var(--cinza-borda);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 32px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .top-bar__brand {
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 20px;
            color: var(--verde);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .top-bar__brand span {
            color: var(--azul);
        }

        .top-menu {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .top-menu a,
        .top-menu button {
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            background: none;
            text-decoration: none;
            color: var(--texto-suave);
            padding: 6px 12px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }

        .top-menu a:hover,
        .top-menu button:hover {
            background: var(--cinza-bg);
            color: var(--texto);
        }

        .top-menu .separator {
            color: var(--cinza-borda);
            font-size: 18px;
            user-select: none;
        }

        .btn-register {
            background: var(--verde) !important;
            color: var(--branco) !important;
            border-radius: 50px !important;
            padding: 8px 20px !important;
            font-weight: 600 !important;
            transition: background 0.2s, transform 0.1s !important;
        }

        .btn-register:hover {
            background: var(--verde-light) !important;
            transform: translateY(-1px);
        }

        .login-link {
            color: var(--verde) !important;
        }

        /* ── HERO (só na home) ──────────────────────────────── */
        .hero {
            text-align: center;
            padding: 80px 24px 60px;
            background: linear-gradient(160deg, #f0faf5 0%, #e8f0fc 100%);
            border-bottom: 1px solid var(--cinza-borda);
        }

        .hero__eyebrow {
            display: inline-block;
            font-family: 'Sora', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--verde);
            background: var(--verde-xlight);
            padding: 5px 14px;
            border-radius: 50px;
            margin-bottom: 20px;
        }

        .hero__title {
            font-family: 'Sora', sans-serif;
            font-size: clamp(32px, 5vw, 52px);
            font-weight: 700;
            color: var(--texto);
            letter-spacing: -1.5px;
            line-height: 1.15;
            margin-bottom: 14px;
        }

        .hero__title em {
            font-style: normal;
            color: var(--verde);
        }

        .hero__subtitle {
            font-size: 17px;
            color: var(--texto-suave);
            font-weight: 300;
            margin-bottom: 40px;
        }

        /* ── BUSCA ──────────────────────────────────────────── */
        .search-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
            max-width: 520px;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--texto-suave);
            pointer-events: none;
        }

        .search-wrapper input[type="text"] {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid var(--cinza-borda);
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            color: var(--texto);
            outline: none;
            background: var(--branco);
            box-shadow: var(--shadow);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-wrapper input[type="text"]:focus {
            border-color: var(--verde);
            box-shadow: 0 0 0 4px rgba(30,125,90,0.12);
        }

        .autocomplete-items {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            background: var(--branco);
            border: 1px solid var(--cinza-borda);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            z-index: 200;
            overflow: hidden;
        }

        .autocomplete-item {
            padding: 12px 20px;
            cursor: pointer;
            font-size: 15px;
            color: var(--texto);
            transition: background 0.15s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .autocomplete-item::before {
            content: '📍';
            font-size: 13px;
        }

        .autocomplete-item:hover {
            background: var(--verde-xlight);
        }

        .search-submit {
            display: block;
            margin: 20px auto 0;
            padding: 12px 36px;
            background: var(--verde);
            color: var(--branco);
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(30,125,90,0.25);
        }

        .search-submit:hover {
            background: var(--verde-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30,125,90,0.3);
        }

        /* ── CONTEÚDO PRINCIPAL ─────────────────────────────── */
        .page-content {
            flex: 1;
            width: 100%;
            margin: 0 auto;
        }

        /* ── RODAPÉ ─────────────────────────────────────────── */
        .footer {
            background: var(--branco);
            border-top: 1px solid var(--cinza-borda);
            text-align: center;
            padding: 24px;
        }

        .footer p {
            font-size: 13px;
            color: var(--texto-suave);
            line-height: 1.8;
        }

        .footer strong {
            color: var(--verde);
            font-weight: 600;
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- ── TOPO ─────────────────────────────────────────────── --}}
    <header class="top-bar">
        <a href="/" class="top-bar__brand">Cidade<span>Conecta</span></a>

        <nav class="top-menu">
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
        </nav>
    </header>

    {{-- ── CONTEÚDO DA PÁGINA ──────────────────────────────── --}}
    <main class="page-content">
        @yield('hero')
        @yield('conteudo')
    </main>

    {{-- ── RODAPÉ ───────────────────────────────────────────── --}}
    <footer class="footer">
        <p><strong>Cidade Conecta</strong> — Portal do Cidadão</p>
        <p>📞 (00) 1234-5678 &nbsp;|&nbsp; ✉️ contato@cidadeconecta.gov.br</p>
    </footer>

    {{-- ── AUTOCOMPLETE (só ativo quando o hero estiver visível) --}}
    @hasSection('hero')
        <script>
            const input = document.getElementById("cidadeInput");
            const autocompleteList = document.getElementById("autocomplete-list");
            let debounceTimer;

            input.addEventListener("input", function () {
                const val = this.value.trim();
                clearTimeout(debounceTimer);
                autocompleteList.innerHTML = "";

                if (!val) { autocompleteList.style.display = "none"; return; }

                debounceTimer = setTimeout(() => {
                    fetch(`/cidades/autocomplete?q=${encodeURIComponent(val)}`)
                        .then(r => r.json())
                        .then(cidades => {
                            autocompleteList.innerHTML = "";
                            if (!cidades.length) { autocompleteList.style.display = "none"; return; }

                            cidades.forEach(cidade => {
                                const item = document.createElement("div");
                                item.classList.add("autocomplete-item");
                                item.innerHTML =
                                    `<strong>${cidade.nome.substring(0, val.length)}</strong>${cidade.nome.substring(val.length)}`;
                                item.addEventListener("click", () => {
                                    window.location.href = `/agenda-municipal/${cidade.id}`;
                                });
                                autocompleteList.appendChild(item);
                            });

                            autocompleteList.style.display = "block";
                        });
                }, 300);
            });

            document.addEventListener("click", function (e) {
                if (e.target !== input) {
                    autocompleteList.style.display = "none";
                }
            });

            document.querySelector(".hero form").addEventListener("submit", function (e) {
                e.preventDefault();
                const val = input.value.trim();
                if (!val) return;

                fetch(`/cidades/autocomplete?q=${encodeURIComponent(val)}`)
                    .then(r => r.json())
                    .then(cidades => {
                        if (cidades.length > 0) {
                            window.location.href = `/agenda-municipal/${cidades[0].id}`;
                        } else {
                            alert("Cidade não encontrada.");
                        }
                    });
            });
        </script>
    @endif

    @stack('scripts')

</body>
</html>
