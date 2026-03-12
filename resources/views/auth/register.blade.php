<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-300 via-emerald-400 to-green-600">

    <div class="backdrop-blur-lg bg-white/80 shadow-2xl rounded-3xl p-10 w-full max-w-md border border-white/40">

        <h1 class="text-3xl font-bold text-center text-green-700 mb-2">
            Criar conta
        </h1>

        <p class="text-center text-gray-500 mb-6">
            Cadastre-se para ser admin
        </p>

        {{-- erros gerais --}}
        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- Nome --}}
            <div>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Nome completo"
                    required
                    autofocus
                    autocomplete="name"
                    class="w-full px-4 py-3 rounded-xl border
                    @error('name') border-red-500 @else border-gray-200 @enderror
                    focus:border-green-500 focus:ring-2 focus:ring-green-300 outline-none transition"
                >

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- CPF --}}
            <div>
                <input
                    type="text"
                    name="cpf"
                    value="{{ old('cpf') }}"
                    placeholder="CPF"
                    required
                    maxlength="14"
                    autocomplete="off"
                    class="w-full px-4 py-3 rounded-xl border
                    @error('cpf') border-red-500 @else border-gray-200 @enderror
                    focus:border-green-500 focus:ring-2 focus:ring-green-300 outline-none transition"
                >

                @error('cpf')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email"
                    required
                    autocomplete="username"
                    class="w-full px-4 py-3 rounded-xl border
                    @error('email') border-red-500 @else border-gray-200 @enderror
                    focus:border-green-500 focus:ring-2 focus:ring-green-300 outline-none transition"
                >

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Senha --}}
            <div>
                <input
                    type="password"
                    name="password"
                    placeholder="Senha"
                    required
                    autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-xl border
                    @error('password') border-red-500 @else border-gray-200 @enderror
                    focus:border-green-500 focus:ring-2 focus:ring-green-300 outline-none transition"
                >

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirmar senha --}}
            <div>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirmar senha"
                    required
                    autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200
                    focus:border-green-500 focus:ring-2 focus:ring-green-300 outline-none transition"
                >
            </div>

            {{-- Botão --}}
            <button
                type="submit"
                class="w-full py-3 rounded-xl text-white font-bold bg-gradient-to-r from-green-500 to-emerald-600 hover:scale-[1.02] active:scale-[0.98] transition shadow-lg">
                Cadastrar
            </button>

            <p class="text-center text-sm text-gray-600">
                Já possui conta?
                <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:underline">
                    Entrar
                </a>
            </p>

        </form>

    </div>

</div>

<script>
    document.querySelector('input[name="cpf"]').addEventListener('input', function(e) {
        let v = e.target.value.replace(/\D/g,'');

        v = v.replace(/(\d{3})(\d)/,'$1.$2');
        v = v.replace(/(\d{3})(\d)/,'$1.$2');
        v = v.replace(/(\d{3})(\d{1,2})$/,'$1-$2');

        e.target.value = v;
    });
</script>

</x-guest-layout>
