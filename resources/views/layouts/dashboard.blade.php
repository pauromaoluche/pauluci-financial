<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pauluci Financial</title>
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>

<body class="min-h-screen bg-gray-50 text-gray-800 antialiased flex flex-col">
    <header class="bg-white shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 md:px-6">
            <div class="flex items-center gap-2">
                <svg class="h-8 w-8 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M4 4h16v3H4zM3 8h18v2H3zM4 12h16v8H4z" />
                </svg>
                <span class="text-lg font-semibold">MyBank</span>
            </div>

            <div class="flex items-center gap-4">
                <button class="relative">
                    <svg class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none" stroke="currentColor"
                        stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.405-4.215a1 1 0 0 0-.95-.685H15m0 0V9a3 3 0 1 0-6 0v3m6 0H9m0 0H5.355a1 1 0 0 0-.95.685L3 17h6" />
                    </svg>
                </button>
                <img src="https://i.pravatar.cc/40" alt="Avatar" class="h-8 w-8 rounded-full ring-2 ring-blue-500" />
            </div>
        </div>
    </header>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-white py-4 text-center text-sm text-gray-400">
        © 2025 MyBank S.A. • Todos os direitos reservados
    </footer>

    @livewireScripts
    @vite('resources/js/app.js')
</body>

</html>
