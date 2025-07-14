<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pauluci Financial</title>
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>

<body class="min-h-screen flex flex-col bg-gray-50 text-gray-800 antialiased">
    <header class="w-full bg-white/80 backdrop-blur shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 md:px-6">
            <div class="flex items-center gap-2">
                <svg class="h-8 w-8 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M4 4h16v3H4zM3 8h18v2H3zM4 12h16v8H4z" />
                </svg>
                <span class="text-lg font-semibold">{{ config('app.name') }}</span>
            </div>
            <nav class="hidden sm:flex items-center gap-6 text-sm">
                <a href="#features" class="hover:text-blue-600">Recursos</a>
                <a href="#security" class="hover:text-blue-600">Segurança</a>
                <a href="#support" class="hover:text-blue-600">Suporte</a>
            </nav>
        </div>
    </header>
    <main class="flex-grow">
        {{ $slot }}
    </main>
    <footer class="bg-white py-6 text-center text-sm text-gray-400">
        © 2025 {{ config('app.name') }} S.A. • Todos os direitos reservados
    </footer>
    @livewireScripts
    @vite('resources/js/app.js')
</body>

</html>
