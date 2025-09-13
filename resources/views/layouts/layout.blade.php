@php
    $imageUrl = asset('images/default-share.png'); 
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>@yield('titulo', 'Encontrá tu mascota')</title>
    <meta name="description" content="@yield('descripcion', 'Encontrá tu mascota perdida en el evento del milagro de Salta')">
    <meta scale="1.0" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="{{ $imageUrl }}" />
    <meta name="twitter:image" content="{{ $imageUrl }}">
    @vite('resources/js/app.js') {{-- Include your compiled assets --}}
    @vite('resources/css/app.css')
    @stack('styles')
    @livewireScripts
    @livewireStyles
    @yield('head')
</head>

<body class="">
    <header class="fixed top-4 z-50 w-full px-4">
        @include('components.header')
    </header>

    <main class="text-pretty bg-gray-50">
        @yield('contenido')
    </main>

    @include('components.footer')
    @stack('scripts')
</body>

</html>
