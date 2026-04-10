<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Agenda Municipal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --brand-dark:   #0f2e1a;
            --brand-green:  #1a5c32;
            --brand-mid:    #2d8c53;
            --brand-light:  #4eb876;
            --brand-gold:   #c9a84c;
            --brand-cream:  #f7f3ec;
            --brand-white:  #ffffff;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--brand-cream);
            min-height: 100vh;
            display: flex;
        }

        /* ── PAINEL ESQUERDO ── */
        .auth-panel-left {
            display: none;
            position: relative;
            width: 46%;
            min-height: 100vh;
            background: var(--brand-dark);
            overflow: hidden;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem;
        }

        @media (min-width: 1024px) {
            .auth-panel-left { display: flex; }
        }

        /* Grade decorativa */
        .auth-panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(var(--brand-green) 1px, transparent 1px),
                linear-gradient(90deg, var(--brand-green) 1px, transparent 1px);
            background-size: 48px 48px;
            opacity: .25;
        }

        /* Gradiente de sobreposição */
        .auth-panel-left::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 30% 60%, rgba(77,184,118,.18) 0%, transparent 65%),
                        linear-gradient(160deg, rgba(15,46,26,.0) 0%, rgba(15,46,26,.85) 100%);
        }

        .left-content { position: relative; z-index: 1; }

        /* Logo */
        .brand-logo {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .brand-logo-icon {
            width: 44px;
            height: 44px;
            background: var(--brand-gold);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-logo-icon svg { width: 24px; height: 24px; color: var(--brand-dark); }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--brand-white);
            letter-spacing: -.01em;
        }

        /* Headline central */
        .left-headline {
            margin-top: auto;
            margin-bottom: 4rem;
        }

        .left-headline-tag {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(201,168,76,.15);
            border: 1px solid rgba(201,168,76,.35);
            border-radius: 99px;
            padding: .3rem .9rem;
            font-size: .75rem;
            font-weight: 500;
            color: var(--brand-gold);
            letter-spacing: .06em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }

        .left-headline h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 3.5vw, 2.8rem);
            font-weight: 700;
            color: var(--brand-white);
            line-height: 1.2;
            letter-spacing: -.02em;
            margin-bottom: 1rem;
        }

        .left-headline h2 em {
            font-style: italic;
            color: var(--brand-gold);
        }

        .left-headline p {
            font-size: .9rem;
            color: rgba(255,255,255,.55);
            line-height: 1.65;
            max-width: 30ch;
        }

        /* Stats */
        .left-stats {
            display: flex;
            gap: 2.5rem;
        }

        .stat-item { }
        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--brand-white);
        }
        .stat-label {
            font-size: .72rem;
            color: rgba(255,255,255,.45);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-top: .15rem;
        }

        /* Círculo decorativo */
        .deco-circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.07);
        }
        .deco-circle-1 { width: 320px; height: 320px; top: -80px; right: -100px; }
        .deco-circle-2 { width: 480px; height: 480px; top: -160px; right: -200px; }
        .deco-circle-3 { width: 200px; height: 200px; bottom: 80px; left: -60px; }

        /* ── PAINEL DIREITO ── */
        .auth-panel-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            min-height: 100vh;
            background: var(--brand-cream);
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
        }

        /* Logo mobile */
        .mobile-logo {
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: 2.5rem;
            justify-content: center;
        }

        @media (min-width: 1024px) { .mobile-logo { display: none; } }

        .mobile-logo-icon {
            width: 38px;
            height: 38px;
            background: var(--brand-green);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-logo-icon svg { width: 20px; height: 20px; color: #fff; }

        .mobile-logo-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--brand-dark);
        }

        /* Título da tela */
        .auth-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--brand-dark);
            letter-spacing: -.02em;
            margin-bottom: .4rem;
        }

        .auth-card-subtitle {
            font-size: .875rem;
            color: #7a8a7d;
            margin-bottom: 2rem;
        }

        /* ── FORM ELEMENTS ── */
        .field-group { margin-bottom: 1.1rem; }

        .field-label {
            display: block;
            font-size: .78rem;
            font-weight: 600;
            color: var(--brand-dark);
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: .45rem;
        }

        .field-input {
            width: 100%;
            padding: .78rem 1rem;
            background: #fff;
            border: 1.5px solid #dde4db;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            color: var(--brand-dark);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        .field-input:focus {
            border-color: var(--brand-mid);
            box-shadow: 0 0 0 3px rgba(45,140,83,.12);
        }

        .field-input.error { border-color: #e05252; }

        .field-error {
            font-size: .78rem;
            color: #e05252;
            margin-top: .35rem;
        }

        /* Checkbox */
        .checkbox-row {
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: .5rem;
        }

        .checkbox-row input[type="checkbox"] {
            width: 17px;
            height: 17px;
            border-radius: 5px;
            border: 1.5px solid #dde4db;
            accent-color: var(--brand-green);
            cursor: pointer;
        }

        .checkbox-row label {
            font-size: .85rem;
            color: #5a6b5d;
            cursor: pointer;
        }

        /* Botão primário */
        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: .85rem 1.5rem;
            background: var(--brand-green);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .15s, box-shadow .2s;
            letter-spacing: .01em;
            text-decoration: none;
            margin-top: 1.5rem;
            box-shadow: 0 4px 14px rgba(26,92,50,.25);
        }

        .btn-primary:hover {
            background: var(--brand-mid);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(26,92,50,.3);
        }

        .btn-primary:active { transform: translateY(0); }

        /* Link sutil */
        .auth-link {
            color: var(--brand-green);
            text-decoration: none;
            font-weight: 500;
            transition: color .15s;
        }

        .auth-link:hover { color: var(--brand-mid); text-decoration: underline; }

        /* Linha divisória */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #dde4db;
        }

        .auth-divider span { font-size: .78rem; color: #9aaa9d; }

        /* Alert success */
        .alert-success {
            background: rgba(78,184,118,.12);
            border: 1px solid rgba(78,184,118,.3);
            border-radius: 10px;
            padding: .75rem 1rem;
            font-size: .84rem;
            color: var(--brand-green);
            margin-bottom: 1.25rem;
        }

        /* Alert error */
        .alert-error {
            background: rgba(224,82,82,.08);
            border: 1px solid rgba(224,82,82,.25);
            border-radius: 10px;
            padding: .75rem 1rem;
            font-size: .84rem;
            color: #c94444;
            margin-bottom: 1.25rem;
        }

        /* Rodapé do card */
        .auth-card-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: .84rem;
            color: #7a8a7d;
        }

        /* Animação de entrada */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .auth-card { animation: fadeUp .45s ease both; }
    </style>
</head>

<body>

    <!-- PAINEL ESQUERDO (decorativo) -->
    <aside class="auth-panel-left">
        <div class="deco-circle deco-circle-1"></div>
        <div class="deco-circle deco-circle-2"></div>
        <div class="deco-circle deco-circle-3"></div>

        <!-- Logo -->
        <div class="left-content brand-logo">
            <div class="brand-logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="brand-name">{{ config('app.name', 'Agenda Municipal') }}</span>
        </div>

        <!-- Headline -->
        <div class="left-content left-headline">
            <div class="left-headline-tag">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="8"/>
                </svg>
                Plataforma de gestão pública
            </div>
            <h2>Conectando cidades,<br><em>organizando eventos</em></h2>
            <p>Gerencie a agenda cultural e pública do seu município de forma simples, centralizada e eficiente.</p>
        </div>

        <!-- Stats -->
        <div class="left-content left-stats">
            <div class="stat-item">
                <div class="stat-value">+50</div>
                <div class="stat-label">Cidades</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">+200</div>
                <div class="stat-label">Eventos</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">100%</div>
                <div class="stat-label">Gratuito</div>
            </div>
        </div>
    </aside>

    <!-- PAINEL DIREITO (formulário) -->
    <main class="auth-panel-right">

        <!-- Logo mobile -->
        <div class="mobile-logo">
            <div class="mobile-logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="mobile-logo-name">{{ config('app.name', 'Agenda Municipal') }}</span>
        </div>

        <div class="auth-card">
            {{ $slot }}
        </div>

    </main>

</body>
</html>
