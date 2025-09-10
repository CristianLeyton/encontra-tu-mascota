@php
    $user = Auth::user();
@endphp
@extends('layouts.layout')

@section('titulo', 'Encontrá tu mascota')

@section('contenido')
    <div class="pt-8 pb-2 container mx-auto xl:max-w-6xl">
        {{-- Hero principal --}}
        <div class="text-center mb-10 text-pretty">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Ayuda a reunir mascotas con sus familias
            </h1>
            <p class="text-gray-600 text-lg md:text-xl mb-6">
                Si encontraste o perdiste una mascota, <span class="text-amber-600">¡Publicalo aqui!</span> <br>
                Juntos podemos hacer la diferencia en la vida de estos animales. <br>
                Publicá tu mascota en esta página para que la gente pueda encontrarla.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                @if ($user)
                    <a href="{{ url('/admin/posts?action=create') }}"
                        class="bg-amber-600 text-white rounded-lg px-3 py-1.5 hover:-translate-y-0.5 transition flex items-center gap-1.5 w-full sm:w-fit justify-center">
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
                    class="bg-white border border-amber-500 text-amber-600 rounded-lg px-3 py-1.5 hover:-translate-y-0.5 transition flex items-center gap-1.5 w-full sm:w-fit justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                    Ver publicaciones
                </a>
            </div>
        </div>

        {{-- Consejos / Información --}}
        <p class="text-lg text-gray-800 font-semibold">Consejos para publicar:</p>
        {{-- Seguridad y Buenas Prácticas --}}
        <div class="mt-6 container mx-auto xl:max-w-6xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                {{-- Disclaimer --}}
                <div
                    class="flex col-span-full lg:col-span-1 items-center gap-3 bg-white rounded-xl shadow-md px-4 py-3 border border-gray-100">
                    <div class="p-2 rounded-lg bg-green-100 text-green-600 text-xl mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Coordiná encuentros seguros</p>
                        <p class="text-xs text-gray-500">
                            La plataforma es colaborativa; se recomienda reunirse en lugares públicos y seguros.
                        </p>
                    </div>
                </div>

                {{-- Fotos propias --}}
                <div class="flex items-center gap-3 bg-white rounded-xl shadow-md px-4 py-3 border border-gray-100">
                    <div class="p-2 rounded-lg bg-blue-100 text-blue-600 text-xl mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>

                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Fotos propias o permitidas</p>
                        <p class="text-xs text-gray-500">
                            Solo subí fotos que sean tuyas o para las que tengas permiso.
                        </p>
                    </div>
                </div>

                {{-- No datos sensibles --}}
                <div class="flex items-center gap-3 bg-white rounded-xl shadow-md px-4 py-3 border border-gray-100">
                    <div class="p-2 rounded-lg bg-red-100 text-red-600 text-xl mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">No exponer datos sensibles</p>
                        <p class="text-xs text-gray-500">
                            Evitá subir documentos, direcciones exactas o teléfonos de menores.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        @include('components.advice')

    </div>
@endsection
