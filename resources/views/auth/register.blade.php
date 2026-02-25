<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-300 via-emerald-400 to-green-600">

        <div class="backdrop-blur-lg bg-white/80 shadow-2xl rounded-3xl p-10 w-full max-w-md border border-white/40">

            <h1 class="text-3xl font-bold text-center text-green-700 mb-2">
                Criar conta
            </h1>

            <p class="text-center text-gray-500 mb-6">
                Cadastre-se para continuar
            </p>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Nome --}}
                <div>
                    <input type="text" name="name" placeholder="Nome completo"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-300 outline-none transition">
                </div>

                {{-- CPF --}}
                <div>
                    <input type="text" name="cpf" placeholder="CPF"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-300 outline-none transition">
                </div>

                {{-- Email --}}
                <div>
                    <input type="email" name="email" placeholder="Email"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-300 outline-none transition">
                </div>

                {{-- Senha --}}
                <div>
                    <input type="password" name="password" placeholder="Senha"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-300 outline-none transition">
                </div>

                {{-- Confirmar --}}
                <div>
                    <input type="password" name="password_confirmation" placeholder="Confirmar senha"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-300 outline-none transition">
                </div>

                {{-- Botão --}}
                <button
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

    </x-guest-layout>
