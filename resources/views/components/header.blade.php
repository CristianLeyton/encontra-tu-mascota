{{-- resources/views/components/header.blade.php --}}


<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();

?>

<header id="header" class="bg-white shadow-md rounded-xl container mx-auto xl:max-w-6xl">
    <nav class="flex justify-between items-center px-4 py-2 md:py-0 text-sm relative text-amber-600">
        <a href="{{ url('/') }}" class="hover:-translate-y-0.5 transition">
            {{-- <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-10 w-auto"> --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: currentColor;transform: ;msFilter:;" class="size-10">
                <path
                    d="M21 6h-2l-1.27-1.27A2.49 2.49 0 0 0 16 4h-2.5A2.64 2.64 0 0 0 11 2v6.36a4.38 4.38 0 0 0 1.13 2.72 6.57 6.57 0 0 0 4.13 1.82l3.45-1.38a3 3 0 0 0 1.73-1.84L22 8.15a1.06 1.06 0 0 0 0-.31V7a1 1 0 0 0-1-1zm-5 2a1 1 0 1 1 1-1 1 1 0 0 1-1 1z">
                </path>
                <path
                    d="M11.38 11.74A5.24 5.24 0 0 1 10.07 9H6a1.88 1.88 0 0 1-2-2 1 1 0 0 0-2 0 4.69 4.69 0 0 0 .48 2A3.58 3.58 0 0 0 4 10.53V22h3v-5h6v5h3v-8.13a7.35 7.35 0 0 1-4.62-2.13z">
                </path>
            </svg>
        </a>

        <div id="navBar"
            class="hidden p-4 md:p-2 md:px-0 md:flex gap-1 md:gap-3 lg:gap-6 text-slate-600 *:hover:text-amber-700 bg-white w-full md:w-fit shadow-md rounded-xl md:shadow-none  top-16 left-0 text-left *:hover:bg-slate-100 *:p-2 *:rounded *:transition">
            <a href="{{ url('/') }}" class="flex items-center gap-1.5 {{ request()->is('/') ? 'text-amber-700' : 'text-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                </svg>
                Publicaciones
            </a>

            @if ($user)
                <a href="{{ url('/admin/posts?action=create') }}" class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: currentColor;transform: ;msFilter:;" class="size-5">
                        <path
                            d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm4 14c0 2.206-1.794 4-4 4H4V8c0-2.206 1.794-4 4-4h8c2.206 0 4 1.794 4 4v8z">
                        </path>
                        <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path>
                    </svg>
                    Publicar
                </a>
            @endif
            <a href="{{ route('resolved') }}"
                class="flex items-center gap-1.5 {{ request()->is('resueltos') ? 'text-amber-700' : 'text-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="size-5"
                    style="fill: currentColor;transform: ;msFilter:;">
                    <path
                        d="M20 7h-4V4c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H4c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9c0-1.103-.897-2-2-2zM4 11h4v8H4v-8zm6-1V4h4v15h-4v-9zm10 9h-4V9h4v10z">
                    </path>
                </svg>
                Resueltos
            </a>
        </div>

        <div class="flex gap-4 items-center">
            <a class="bg-amber-600 text-white rounded-lg px-3 py-1.5 hover:-translate-y-0.5 transition flex items-center gap-1.5"
                href="{{ url('/admin') }}" title="Panel de administración">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>

                {{ $user ? $user->name : 'Iniciar sesión' }}


            </a>

            @if ($user)
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button title="Cerrar sesión" type="submit"
                        class="text-amber-700 hover:underline cursor-pointer flex items-center gap-1.5 transition hover:bg-slate-100 rounded-lg p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>
                        Cerrar sesión
                    </button>
                </form>
            @endif

            <button id="menu-button"
                class="md:hidden flex items-center gap-2 text-slate-600 hover:text-slate-950 cursor-pointer"
                type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </nav>
</header>


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const navBar = document.getElementById("navBar");
            const menuButton = document.getElementById("menu-button");

            function openMenu() {
                navBar?.classList.remove("hidden", "close-menu-animation");
                navBar?.classList.add("flex", "flex-col", "absolute", "open-menu-animation");
            }

            function closeMenu() {
                navBar?.classList.remove("open-menu-animation");
                navBar?.classList.add("close-menu-animation");

                setTimeout(() => {
                    navBar?.classList.remove("flex", "flex-col", "absolute", "close-menu-animation");
                    navBar?.classList.add("hidden");
                }, 200);
            }

            menuButton?.addEventListener("click", (event) => {
                event.stopPropagation();
                if (navBar?.classList.contains("hidden")) {
                    openMenu();
                } else {
                    closeMenu();
                }
            });

            document.addEventListener("click", (event) => {
                if (
                    navBar &&
                    !navBar.contains(event.target) &&
                    !menuButton.contains(event.target) &&
                    !navBar.classList.contains("hidden")
                ) {
                    closeMenu();
                }
            });

            window.addEventListener("resize", () => {
                if (navBar?.classList.contains("open-menu-animation")) {
                    closeMenu();
                }
            });

            navBar?.addEventListener("click", (event) => {
                const target = event.target;
                if (target.closest("a")) return;
                event.stopPropagation();
            });
        });
    </script>
@endpush
