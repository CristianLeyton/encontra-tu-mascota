@php
            $user = Auth::user();
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>@yield('titulo', 'Encontrá tu mascota')</title>
    <meta name="description" content="@yield('descripcion', 'Encontrá tu mascota perdida en el evento del milagro de Salta')">
    <meta scale="1.0" name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/js/app.js') {{-- Include your compiled assets --}}
    @vite('resources/css/app.css')
    @stack('styles')
    @livewireScripts
    @livewireStyles
</head>
<body class="p-4 container mx-auto">
    <header>
        @include('components.header')
    </header>

    <main class="">

        @if (!$user)
            <p class="text-center text-slate-500 text-sm pt-4">
                <a href="{{ url('/admin') }}" class="text-amber-600">Entrá a tu cuenta</a> para crear o editar publicaciones.
            </p>
        @endif
        @yield('contenido') 
    </main>

    @include('components.footer')
    @stack('scripts')
</body>
</html>