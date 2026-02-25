<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CidadeConecta</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-400 to-purple-500">

    <div class="min-h-screen flex flex-col items-center justify-center">

        <!-- Título -->
        <div class="mb-6 text-white text-3xl font-bold">
            CidadeConecta
        </div>

        <!-- Caixa do conteúdo -->
        <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-lg rounded-xl">
            {{ $slot }}
        </div>

    </div>

</body>
</html>
