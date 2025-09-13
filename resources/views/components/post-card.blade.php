<div
    class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col justify-between">

    <div class="flex justify-between items-center text-xs text-gray-500 p-4">
        @if ($post->is_missing)
            <span
                class="text-rose-600 bg-rose-50 hover:bg-rose-200/50 rounded-full px-3 py-1.5 transition items-center cursor-default font-semibold">
                Perdido
            </span>
        @else
            <span
                class="text-cyan-600 bg-cyan-50 hover:bg-cyan-200/50 rounded-full px-3 py-1.5 transition items-center cursor-default font-semibold">
                Encontrado
            </span>
        @endif
        <a href="{{ $post->location ? 'https://www.google.com/maps/search/' . urlencode($post->location) : null }}"
            class="inline-flex gap-1 text-lime-600 bg-lime-50 hover:bg-lime-200/50 rounded-full px-3 py-1.5 transition items-center cursor-pointer font-semibold max-w-[70%] group duration-300"
            target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5 block shrink-0 group-hover:scale-110 transition duration-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <span
                class="text-left overflow-hidden whitespace-nowrap truncate max-w-[90%]">{{ $post->location ?? 'Ubicación aproximada' }}</span>
        </a>
    </div>

    @php
        $images = is_array($post->images) ? $post->images : json_decode($post->images, true);
    @endphp

    @if (!empty($images) && isset($images[0]))
        <a href="{{ url('/publicaciones/' . $post->slug) }}">
            <img src="{{ asset('/storage_public/' . $images[0]) }}" alt="{{ $post->title }}"
                class="w-full aspect-video object-contain">
        </a>
    @else
        {{-- Placeholder si no hay imágenes --}}
        <div class="aspect-video bg-gray-200 flex items-center justify-center text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: currentColor;transform: ;msFilter:;" class="size-40">
                <path
                    d="M19.999 4h-16c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-13.5 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm5.5 10h-7l4-5 1.5 2 3-4 5.5 7h-7z">
                </path>
            </svg>
        </div>
    @endif

    {{-- Contenido --}}
    <div class="px-4 py-2 flex flex-col gap-1">
        <h2 class="text-xl font-semibold text-gray-800 line-clamp-1">
            {{ $post->title }}
        </h2>
        {{-- Información extra de la mascota --}}
        <div class="flex text-sm text-gray-500 gap-1 border border-gray-100 rounded-full font-semibold bg-gray-50 px-3 py-1.5 w-fit">
            <span class="">
                {{ $post->species->icon . '   ' . $post->species->name }}
            </span>

            @if ($post->breed)
                <span class="">
                    {{ lcfirst($post->breed->name ?? 'Raza') }}
                </span>
            @endif

            @if ($post->color)
                <span class="">
                    {{ lcfirst($post->color) }}
                </span>
            @endif

            <span class="">
                {{ $post->size }}
            </span>
        </div>

        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
            {{ $post->description }}
        </p>


        {{-- Datos de contacto --}}
        @if (!$post->is_resolved)
            <div
                class="grid md:grid-cols-2 align-items-center justify-items-center text-sm text-gray-700 rounded-md bg-gray-50 border border-gray-100 p-2 gap-2">

                <span class="flex items-center gap-1 max-w-[99%]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span
                        class="text-left overflow-hidden whitespace-nowrap truncate max-w-[90%]">{{ $post->name_contact ?? 'Anónimo' }}</span>
                </span>

                <span class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                    {{ $post->date->format('d/m/Y') }}
                </span>

                @if ($post->email_contact)
                    <a href="mailto:{{ $post->email_contact }}"
                        class="flex gap-1 text-sky-600 bg-sky-50 hover:bg-sky-200/50 rounded-full px-3 py-1.5 transition items-center font-semibold text-sm col-span-full"
                        target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>

                        {{ $post->email_contact }}
                    </a>
                @endif

                @if ($post->phone_contact)
                    <a href="https://wa.me/{{ $post->phone_contact }}"
                        class="flex gap-1 text-green-600 bg-green-50 hover:bg-green-200/50 rounded-full px-3 py-1.5 transition items-center font-semibold text-sm col-span-full"
                        target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="size-6"
                            viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                            </path>
                        </svg>
                        {{ $post->phone_contact }}
                    </a>
                @endif
            </div>
        @else
            <div class="flex flex-col col-span-full justify-center items-center gap-2 bg-emerald-500 text-white rounded-md px-2 
            py-4 border border-emerald-500 w-full">
                <div
                    class="flex gap-3 items-center text-2xl font-semibold">
                    ¡Caso resuelto!
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-7" width="24" height="24"
                        viewBox="0 0 24 24" style="fill: currentColor;msFilter:;">
                        <path
                            d="M18 8.31c-.36-.41-.73-.82-1.12-1.21l-.29-.27.14-.12a3.15 3.15 0 0 0 .9-3.49A3.91 3.91 0 0 0 14 1v2a2 2 0 0 1 1.76 1c.17.4 0 .84-.47 1.31-.07.08-.15.13-.22.2-3-2.41-6.29-3.77-7.9-2.16a2.16 2.16 0 0 0-.41.59v.1l-.18.53-4.41 13.1A3.28 3.28 0 0 0 5.28 22a3.21 3.21 0 0 0 1-.17L20 17.28a1 1 0 0 0 .43-.31l.21-.18c1.43-1.44.51-4.21-1.41-6.9A6.63 6.63 0 0 1 23 9V7a8.44 8.44 0 0 0-5 1.31zM5.7 19.93a1.29 1.29 0 0 1-1.63-1.63l1.36-4.1a10.7 10.7 0 0 0 4.29 4.39zm7-2.33a8.87 8.87 0 0 1-6.3-6.29l1-3 .06.09c.11.22.25.45.39.68s.16.29.26.44.33.48.51.73.19.28.3.42.43.55.66.82l.29.35c.34.39.7.77 1.08 1.16s.68.64 1 1l.33.28.78.63.37.28c.28.2.55.4.83.58l.31.2c.36.22.72.43 1.07.61h.05zm6.51-2.23h-.06c-.69.38-3.56-.57-6.79-3.81-.34-.34-.66-.67-.95-1l-.29-.35-.53-.64-.29-.4c-.13-.19-.27-.37-.39-.55l-.26-.42-.29-.47c-.08-.14-.14-.27-.21-.4s-.15-.26-.21-.4a3.31 3.31 0 0 1-.14-.36c-.05-.13-.11-.26-.15-.38S8.6 6 8.57 5.88s-.05-.22-.07-.32a2.26 2.26 0 0 1 0-.26 1 1 0 0 1 0-.24l.11-.31c.36-.36 2.23 0 4.73 1.9A4.13 4.13 0 0 1 12 7v2a6.45 6.45 0 0 0 3-.94l.48.46c.42.42.81.85 1.18 1.28a5.32 5.32 0 0 0-.6 3.4l2-.39a3.57 3.57 0 0 1 0-1.12 11.3 11.3 0 0 1 .81 1.45c.56 1.32.52 2.06.34 2.23z">
                        </path>
                    </svg>
                </div>
                <p class="text-center ">
                    Una familia ha sido reunida gracias al apoyo de {{ $post->name_contact ?? 'Anónimo' }}
                </p>
            </div>
        @endif



        {{-- Botón --}}
        <div class="flex items-center w-full gap-2 mt-1">
            <a href="{{ url('/publicaciones/' . $post->slug) }}"
                class="w-full justify-center bg-emerald-600 border border-emerald-500 text-white font-semibold text-sm px-3 py-1.5 rounded-lg hover:bg-emerald-700 transition inline-flex items-center gap-2">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    style="fill: currentColor;transform: ;msFilter:;">
                    <path
                        d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z">
                    </path>
                    <path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path>
                </svg>
                Detalles
            </a>

            @auth
                @if ($post->user_id == auth()->user()->id)
                    <a href="/admin/posts?tableAction=edit&tableActionRecord={{ $post->id }}"
                        class="border bg-transparent border-emerald-600 text-emerald-600 hover:bg-emerald-100/90 rounded-lg px-3 py-1.5 font-semibold text-sm transition flex items-center gap-2 w-full justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="size-6" style="fill: currentColor;transform: ;msFilter:;">
                            <path
                                d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm4 14c0 2.206-1.794 4-4 4H4V8c0-2.206 1.794-4 4-4h8c2.206 0 4 1.794 4 4v8z">
                            </path>
                            <path d="M7 14.987v1.999h1.999l5.529-5.522-1.998-1.998zm8.47-4.465-1.998-2L14.995 7l2 1.999z">
                            </path>
                        </svg>
                        Editar
                    </a>
                @endif
            @endauth


        </div>
    </div>
</div>
