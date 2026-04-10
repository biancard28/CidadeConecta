<x-guest-layout>

    <h1 class="auth-card-title">Bem-vindo de volta</h1>
    <p class="auth-card-subtitle">Entre com suas credenciais para acessar o painel</p>

    {{-- Status (ex: logout, reset de senha) --}}
    @if (session('status'))
        <div class="alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="field-group">
            <label class="field-label" for="email">E-mail</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                class="field-input {{ $errors->has('email') ? 'error' : '' }}"
                placeholder="seu@email.com"
            >
            @error('email')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Senha --}}
        <div class="field-group">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.45rem;">
                <label class="field-label" for="password" style="margin-bottom:0">Senha</label>
                @if (Route::has('password.request'))
                    <a class="auth-link" style="font-size:.8rem;" href="{{ route('password.request') }}">
                        Esqueceu a senha?
                    </a>
                @endif
            </div>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="field-input {{ $errors->has('password') ? 'error' : '' }}"
                placeholder="••••••••"
            >
            @error('password')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lembrar de mim --}}
        <div class="checkbox-row">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">Manter-me conectado</label>
        </div>

        <button type="submit" class="btn-primary">Entrar</button>

    </form>

</x-guest-layout>
