<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pauluci Financial</title>
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>

<body>
    <main class="flex-grow">
        @yield('content')
    </main>
    @livewireScripts
    @vite('resources/js/app.js')
</body>

</html>
