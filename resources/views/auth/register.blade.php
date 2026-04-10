<x-guest-layout>

    <h1 class="auth-card-title">Criar conta</h1>
    <p class="auth-card-subtitle">Cadastre-se para administrar sua cidade</p>

    {{-- Erros gerais --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul style="list-style:none; display:flex; flex-direction:column; gap:.25rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nome --}}
        <div class="field-group">
            <label class="field-label" for="name">Nome completo</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                class="field-input {{ $errors->has('name') ? 'error' : '' }}"
                placeholder="João da Silva"
            >
            @error('name')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- CPF --}}
        <div class="field-group">
            <label class="field-label" for="cpf">CPF</label>
            <input
                id="cpf"
                type="text"
                name="cpf"
                value="{{ old('cpf') }}"
                required
                maxlength="14"
                autocomplete="off"
                class="field-input {{ $errors->has('cpf') ? 'error' : '' }}"
                placeholder="000.000.000-00"
            >
            @error('cpf')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="field-group">
            <label class="field-label" for="email">E-mail</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                class="field-input {{ $errors->has('email') ? 'error' : '' }}"
                placeholder="seu@email.com"
            >
            @error('email')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Senha + Confirmação lado a lado em telas maiores --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:.75rem;">
            <div class="field-group">
                <label class="field-label" for="password">Senha</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    class="field-input {{ $errors->has('password') ? 'error' : '' }}"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field-group">
                <label class="field-label" for="password_confirmation">Confirmar</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="field-input"
                    placeholder="••••••••"
                >
            </div>
        </div>

        <button type="submit" class="btn-primary">Criar conta</button>

    </form>

    <div class="auth-card-footer">
        Já possui conta?
        <a class="auth-link" href="{{ route('login') }}">Entrar</a>
    </div>

</x-guest-layout>

<script>
    document.getElementById('cpf').addEventListener('input', function (e) {
        let v = e.target.value.replace(/\D/g, '');
        v = v.replace(/(\d{3})(\d)/, '$1.$2');
        v = v.replace(/(\d{3})(\d)/, '$1.$2');
        v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = v;
    });
</script>
