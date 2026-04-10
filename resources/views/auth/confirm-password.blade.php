<x-guest-layout>

    {{-- Ícone --}}
    <div style="
        width: 64px; height: 64px;
        background: rgba(201,168,76,.12);
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.5rem;
    ">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none"
             viewBox="0 0 24 24" stroke="#c9a84c" stroke-width="1.7">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
        </svg>
    </div>

    <h1 class="auth-card-title">Área segura</h1>
    <p class="auth-card-subtitle">
        Confirme sua senha para continuar para esta área protegida.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="field-group">
            <label class="field-label" for="password">Senha atual</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autofocus
                autocomplete="current-password"
                class="field-input {{ $errors->has('password') ? 'error' : '' }}"
                placeholder="••••••••"
            >
            @error('password')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-primary">Confirmar acesso</button>

    </form>

</x-guest-layout>
