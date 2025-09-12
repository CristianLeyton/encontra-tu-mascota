@php
    $user = Auth::user();
@endphp
@extends('layouts.layout')

@section('titulo', 'Encontrá tu mascota')

@section('contenido')
    <div class="pt-24 pb-2 bg-emerald-100/70 fade-in-animation">
        {{-- Hero principal --}}
        <div
            class="text-emerald-600 bg-emerald-100/90 hover:bg-emerald-200/50 rounded-full px-4 py-2 hover:-translate-y-0.5 transition flex items-center gap-1.5 w-fit mx-auto cursor-default font-semibold text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
            Plataforma colaborativa
        </div>
        <div class="text-center mt-1 mb-10 text-pretty container mx-auto xl:max-w-6xl p-4 fade-in-animation">
            <div class="text-4xl md:text-5xl 2xl:text-6xl font-bold text-gray-800 mb-4">
                Ayuda a reunir <br> mascotas con sus familias
            </div>
            <div class="text-gray-600 text-xl md:text-2xl 2xl:text-3xl my-6">
                Si encontraste o perdiste una mascota, <span class="text-emerald-600 font-semibold">¡Publicalo aquí!</span>
                <br>
            </div>

            <div class="text-gray-600 text-lg md:text-xl 2xl:text-2xl mb-6">
                Juntos podemos hacer la diferencia en la vida de estos animales. <br>
                Publicá tu mascota en esta página para que la gente pueda encontrarla.
            </div>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                @if ($user)
                    <a href="{{ url('/admin/posts?action=create') }}"
                        class="bg-emerald-600 text-white rounded-lg px-3 py-1.5 hover:-translate-y-0.5 transition flex items-center font-semibold text-sm gap-1.5 w-full sm:w-fit justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: currentColor;transform: ;msFilter:;" class="size-5">
                            <path
                                d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm4 14c0 2.206-1.794 4-4 4H4V8c0-2.206 1.794-4 4-4h8c2.206 0 4 1.794 4 4v8z">
                            </path>
                            <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path>
                        </svg>
                        Crear publicación
                    </a>
                @endif
                <a href="{{ route('unresolved') }}"
                    class="border bg-transparent border-emerald-600 text-emerald-600 hover:bg-emerald-100/90 rounded-lg px-3 py-1.5 font-semibold text-sm hover:-translate-y-0.5 transition flex items-center gap-1.5 w-full sm:w-fit justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                    Ver publicaciones
                </a>
            </div>
        </div>
    </div>

    <div class="py-14 px-4 ">
        {{-- Consejos / Información --}}
        <p class="text-2xl md:text-3xl 2xl:text-4xl text-gray-800 font-bold text-center pb-5">Consejos para publicar</p>
        <p class="text-center text-base md:text-lg 2xl:text-xl text-gray-500">Sigue estas recomendaciones para maximizar <br>
            las posibilidades de encontrar a tu mascota</p>
        {{-- Seguridad y Buenas Prácticas --}}
        <div class="mt-6 container mx-auto max-w-7xl">
            @include('components.advice')
        </div>
    </div>

    <div class="py-14 px-4 bg-gray-50">
        {{-- Como funciona --}}
        <p class="text-2xl md:text-3xl 2xl:text-4xl text-gray-800 font-bold text-center pb-5">¿Cómo funciona?</p>
        <p class="text-center text-base md:text-lg 2xl:text-xl text-gray-500">Tres simples pasos para ayudar a <br> reunir
            mascotas con sus familias</p>

        <div class="mt-6 container mx-auto max-w-6xl grid grid-cols-1 md:grid-cols-3">
            <div class="flex flex-col justify-center text-center items-center gap-2  px-4 py-4 group transition">
                <div class="p-4 rounded-full bg-gray-800 text-white text-xl group-hover:scale-110 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                    </svg>
                </div>

                <p class="text-lg md:text-xl font-semibold text-gray-700">1. Publicá</p>
                <p class="text-base md:text-lg text-gray-500">
                    Subí fotos y detalles de la mascota perdida o encontrada
                </p>

            </div>

            {{-- 2. Compartí --}}
            <div class="flex flex-col justify-center text-center items-center gap-2  px-4 py-4 group transition">
                <div class="p-4 rounded-full bg-gray-800 text-white text-xl group-hover:scale-110 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>

                </div>

                <p class="text-lg md:text-xl font-semibold text-gray-700">2. Compartí</p>
                <p class="text-base md:text-lg text-gray-500">
                    La comunidad ayuda a difundir y buscar activamente
                </p>

            </div>

            {{-- 3. Reuní --}}

            <div class="flex flex-col justify-center text-center items-center gap-2  px-4 py-4 group transition">
                <div class="p-4 rounded-full bg-gray-800 text-white text-xl group-hover:scale-110 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </div>

                <p class="text-lg md:text-xl font-semibold text-gray-700">3. Reuní</p>
                <p class="text-base md:text-lg text-gray-500">
                    Coordiná el encuentro seguro y celebrá el reencuentro
                </p>

            </div>
        </div>
    </div>

    <div class="py-14 pb-6 px-4">
        {{-- ¿Perdiste o encontraste una mascota? --}}
        <div
            class="bg-gradient-to-r from-emerald-200/70 to-emerald-50 text-white text-center py-12 px-6 rounded-xl flex flex-col gap-6  max-w-4xl mx-auto">
            <p class="text-2xl md:text-3xl 2xl:text-4xl text-gray-800 font-bold text-center">¿Perdiste o encontraste una
                mascota?</p>
            <p class="text-center text-base md:text-lg 2xl:text-xl text-gray-700">No esperes más. Cada minuto cuenta cuando
                se trata de reunir familias.
                        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                @if ($user)
                    <a href="{{ url('/admin/posts?action=create') }}"
                        class="bg-emerald-600 text-white rounded-lg px-3 py-1.5 hover:-translate-y-0.5 transition flex items-center font-semibold text-sm gap-1.5 w-full sm:w-fit justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: currentColor;transform: ;msFilter:;" class="size-5">
                            <path
                                d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm4 14c0 2.206-1.794 4-4 4H4V8c0-2.206 1.794-4 4-4h8c2.206 0 4 1.794 4 4v8z">
                            </path>
                            <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path>
                        </svg>
                        Crear publicación
                    </a>
                @endif
                <a href="{{ route('unresolved') }}"
                    class="border bg-transparent border-emerald-600 text-emerald-600 hover:bg-emerald-100/90 rounded-lg px-3 py-1.5 font-semibold text-sm hover:-translate-y-0.5 transition flex items-center gap-1.5 w-full sm:w-fit justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                    Ver publicaciones
                </a>
            </div>
        </div>
    </div>

@endsection
