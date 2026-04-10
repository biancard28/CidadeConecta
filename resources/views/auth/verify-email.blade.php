<x-guest-layout>

    {{-- Ícone ilustrativo --}}
    <div style="
        width: 64px; height: 64px;
        background: rgba(45,140,83,.1);
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.5rem;
    ">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none"
             viewBox="0 0 24 24" stroke="#1a5c32" stroke-width="1.7">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
    </div>

    <h1 class="auth-card-title">Verifique seu e-mail</h1>
    <p class="auth-card-subtitle" style="margin-bottom:1.5rem;">
        Enviamos um link de verificação para o endereço cadastrado.
        Clique no link para ativar sua conta.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert-success">
            Um novo link de verificação foi enviado para o seu e-mail.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn-primary">Reenviar e-mail de verificação</button>
    </form>

    <div class="auth-divider"><span>ou</span></div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="
            width: 100%;
            padding: .75rem;
            background: transparent;
            border: 1.5px solid #dde4db;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: .875rem;
            color: #5a6b5d;
            cursor: pointer;
            transition: border-color .2s, color .2s;
        "
        onmouseover="this.style.borderColor='#1a5c32'; this.style.color='#1a5c32'"
        onmouseout="this.style.borderColor='#dde4db'; this.style.color='#5a6b5d'">
            Sair da conta
        </button>
    </form>

</x-guest-layout>
