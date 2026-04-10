<x-guest-layout>

    <h1 class="auth-card-title">Nova senha</h1>
    <p class="auth-card-subtitle">Escolha uma senha segura para sua conta.</p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="field-group">
            <label class="field-label" for="email">E-mail</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
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

        <div class="field-group">
            <label class="field-label" for="password">Nova senha</label>
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
            <label class="field-label" for="password_confirmation">Confirmar nova senha</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                class="field-input {{ $errors->has('password_confirmation') ? 'error' : '' }}"
                placeholder="••••••••"
            >
            @error('password_confirmation')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-primary">Redefinir senha</button>

    </form>

</x-guest-layout>
