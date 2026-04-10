<x-guest-layout>

    <h1 class="auth-card-title">Esqueceu a senha?</h1>
    <p class="auth-card-subtitle" style="margin-bottom:1.25rem;">
        Informe seu e-mail e enviaremos um link para você criar uma nova senha.
    </p>

    @if (session('status'))
        <div class="alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="field-group">
            <label class="field-label" for="email">E-mail</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="field-input {{ $errors->has('email') ? 'error' : '' }}"
                placeholder="seu@email.com"
            >
            @error('email')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-primary">Enviar link de redefinição</button>

    </form>

    <div class="auth-card-footer">
        Lembrou a senha?
        <a class="auth-link" href="{{ route('login') }}">Voltar ao login</a>
    </div>

</x-guest-layout>
