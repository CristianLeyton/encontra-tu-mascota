<div class="pt-4 pb-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Información principal --}}
        <div
            class="bg-white rounded-xl shadow-md border border-gray-100 p-5 space-y-3 h-fit {{ empty($post->images) ? 'col-span-full' : 'col-span-1' }} ">
            {{-- Título y estado --}}
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    {{ $post->title }}
                </h1>

                {{-- Etiquetas de estado --}}
                <div class="flex justify-center gap-3">
                    @if ($post->is_missing)
                        <span class="px-3 py-1 text-sm rounded-md bg-red-100 text-red-600 font-semibold">
                            Mascota perdida
                        </span>
                    @else
                        <span class="px-3 py-1 text-sm rounded-md bg-cyan-100 text-cyan-600 font-semibold">
                            Mascota encontrada
                        </span>
                    @endif

                    @if ($post->is_resolved)
                        <span
                            class="px-3 py-1 text-sm rounded-md bg-lime-100 text-lime-600 font-semibold flex items-center gap-1">
                            Caso Resuelto <svg xmlns="http://www.w3.org/2000/svg" class="size-6" width="24"
                                height="24" viewBox="0 0 24 24" style="fill: currentColor;msFilter:;">
                                <path
                                    d="M18 8.31c-.36-.41-.73-.82-1.12-1.21l-.29-.27.14-.12a3.15 3.15 0 0 0 .9-3.49A3.91 3.91 0 0 0 14 1v2a2 2 0 0 1 1.76 1c.17.4 0 .84-.47 1.31-.07.08-.15.13-.22.2-3-2.41-6.29-3.77-7.9-2.16a2.16 2.16 0 0 0-.41.59v.1l-.18.53-4.41 13.1A3.28 3.28 0 0 0 5.28 22a3.21 3.21 0 0 0 1-.17L20 17.28a1 1 0 0 0 .43-.31l.21-.18c1.43-1.44.51-4.21-1.41-6.9A6.63 6.63 0 0 1 23 9V7a8.44 8.44 0 0 0-5 1.31zM5.7 19.93a1.29 1.29 0 0 1-1.63-1.63l1.36-4.1a10.7 10.7 0 0 0 4.29 4.39zm7-2.33a8.87 8.87 0 0 1-6.3-6.29l1-3 .06.09c.11.22.25.45.39.68s.16.29.26.44.33.48.51.73.19.28.3.42.43.55.66.82l.29.35c.34.39.7.77 1.08 1.16s.68.64 1 1l.33.28.78.63.37.28c.28.2.55.4.83.58l.31.2c.36.22.72.43 1.07.61h.05zm6.51-2.23h-.06c-.69.38-3.56-.57-6.79-3.81-.34-.34-.66-.67-.95-1l-.29-.35-.53-.64-.29-.4c-.13-.19-.27-.37-.39-.55l-.26-.42-.29-.47c-.08-.14-.14-.27-.21-.4s-.15-.26-.21-.4a3.31 3.31 0 0 1-.14-.36c-.05-.13-.11-.26-.15-.38S8.6 6 8.57 5.88s-.05-.22-.07-.32a2.26 2.26 0 0 1 0-.26 1 1 0 0 1 0-.24l.11-.31c.36-.36 2.23 0 4.73 1.9A4.13 4.13 0 0 1 12 7v2a6.45 6.45 0 0 0 3-.94l.48.46c.42.42.81.85 1.18 1.28a5.32 5.32 0 0 0-.6 3.4l2-.39a3.57 3.57 0 0 1 0-1.12 11.3 11.3 0 0 1 .81 1.45c.56 1.32.52 2.06.34 2.23z">
                                </path>
                            </svg>
                        </span>
                    @endif
                </div>
            </div>

            <a target="_blank"
                href="{{ $post->location ? 'https://www.google.com/maps/search/' . urlencode($post->location) : null }}"
                class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-lime-600 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg> Ubicación aproximada:</span> {{ $post->location }}</a>
            <p class="text-gray-700 flex items-center gap-2"><span class="font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                    Fecha:</span>
                {{ \Carbon\Carbon::parse($post->date)->translatedFormat('d F Y') }}</p>
            <p class="text-gray-700 flex items-center gap-2"><span class="font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-amber-600 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                    </svg>
                    Especie:</span>
                {{ $post->species->name ?? 'No especificado' }}</p>
            <p class="text-gray-700 flex items-center gap-2"><span class="font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-amber-600 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                    </svg>
                    Raza:</span>
                {{ $post->breed->name ?? 'No especificado' }}</p>
            <p class="text-gray-700 flex items-center gap-2"><span class="font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: currentColor;transform: ;msFilter:;" class="size-6 text-cyan-600">
                        <path
                            d="M13.4 2.096a10.08 10.08 0 0 0-8.937 3.331A10.054 10.054 0 0 0 2.096 13.4c.53 3.894 3.458 7.207 7.285 8.246a9.982 9.982 0 0 0 2.618.354l.142-.001a3.001 3.001 0 0 0 2.516-1.426 2.989 2.989 0 0 0 .153-2.879l-.199-.416a1.919 1.919 0 0 1 .094-1.912 2.004 2.004 0 0 1 2.576-.755l.412.197c.412.198.85.299 1.301.299A3.022 3.022 0 0 0 22 12.14a9.935 9.935 0 0 0-.353-2.76c-1.04-3.826-4.353-6.754-8.247-7.284zm5.158 10.909-.412-.197c-1.828-.878-4.07-.198-5.135 1.494-.738 1.176-.813 2.576-.204 3.842l.199.416a.983.983 0 0 1-.051.961.992.992 0 0 1-.844.479h-.112a8.061 8.061 0 0 1-2.095-.283c-3.063-.831-5.403-3.479-5.826-6.586-.321-2.355.352-4.623 1.893-6.389a8.002 8.002 0 0 1 7.16-2.664c3.107.423 5.755 2.764 6.586 5.826.198.73.293 1.474.282 2.207-.012.807-.845 1.183-1.441.894z">
                        </path>
                        <circle cx="7.5" cy="14.5" r="1.5"></circle>
                        <circle cx="7.5" cy="10.5" r="1.5"></circle>
                        <circle cx="10.5" cy="7.5" r="1.5"></circle>
                        <circle cx="14.5" cy="7.5" r="1.5"></circle>
                    </svg> Color:</span> {{ $post->color }}</p>
            <p class="text-gray-700 flex items-center gap-2"><span class="font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                    Tamaño:</span> {{ ucfirst($post->size) }}</p>
        </div>

        {{-- Galería de imágenes con Swiper --}}
        @if (!empty($post->images))
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-5 h-fit ">
                <div class="swiper post-gallery">
                    <div class="swiper-wrapper">
                        @foreach ($post->images as $image)
                            <div class="swiper-slide relative">
                                <img src="{{ asset('storage_public/' . $image) }}" alt="Foto de {{ $post->title }}"
                                    class="object-contain w-full h-72" lazy="true"
                                    loading="lazy">
                                <a href="{{ asset('storage_public/' . $image) }}" target="_blank" title="Ver imagen"
                                    class="absolute top-1 right-1 bg-gray-100 rounded-full p-2 text-gray-400 hover:text-gray-600 transition-all hover:shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;">
                                        <path d="M11 6H9v3H6v2h3v3h2v-3h3V9h-3z"></path>
                                        <path
                                            d="M10 2c-4.411 0-8 3.589-8 8s3.589 8 8 8a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8zm0 14c-3.309 0-6-2.691-6-6s2.691-6 6-6 6 2.691 6 6-2.691 6-6 6z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Controles de navegación --}}
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev text-gray-700"></div>
                    <div class="swiper-button-next text-gray-700"></div>
                </div>
            </div>
        @endif

    </div>

    {{-- Descripción --}}
    @if ($post->description)
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-5 my-4">
            <p class="text-gray-700 text-pretty">{{ $post->description }}</p>
        </div>
    @endif

    {{-- Datos de contacto --}}
    @if (!$post->is_resolved)
        <p class="font-semibold text-gray-700">Datos de contacto: </p>
        <div class="grid gap-2 grid-cols-1 md:grid-cols-2">
            <div
                class="grid md:grid-cols-2 align-items-center justify-items-center bg-white rounded-xl shadow-md px-4 py-3 border border-gray-100 text-gray-600 gap-2">

                <span class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    {{ $post->name_contact ?? 'Anónimo' }}
                </span>

                <span class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>

                    {{ $post->created_at->format('d/m/Y') }}
                </span>

                @if ($post->email_contact)
                    <a href="mailto:{{ $post->email_contact }}" class="flex items-center gap-1.5 text-cyan-600"
                        target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>

                        {{ $post->email_contact }}
                    </a>
                @endif

                @if ($post->phone_contact)
                    <a href="https://wa.me/{{ $post->phone_contact }}"
                        class="flex items-center gap-1.5 text-lime-700" target="_blank">
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

            {{-- Botones de compartir --}}
            <div
                class="flex flex-wrap gap-1.5 items-center justify-center text-sm bg-white rounded-xl shadow-md px-4 py-3 border border-gray-100 text-gray-600">
                <p class="font-semibold text-gray-700 text-base w-full">Compartir en:</p>
                {{-- WhatsApp --}}
                <a href="https://wa.me/?text={{ urlencode('Mascota perdida: ' . $post->title . ' - ' . route('post', $post)) }}"
                    target="_blank"
                    class="px-2 py-1 bg-green-500 hover:bg-green-600 text-white rounded-lg flex items-center gap-1 shadow-md"
                    title="Compartir en WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: currentColor;transform: ;msFilter:;" class="size-6">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                        </path>
                    </svg>
                </a>

                {{-- Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('post', $post)) }}"
                    target="_blank"
                    class="px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center gap-1 shadow-md"
                    title="Compartir en Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: currentColor;transform: ;msFilter:;" class="size-6">
                        <path
                            d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z">
                        </path>
                    </svg>
                </a>

                {{-- Twitter/X --}}
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(route('post', $post)) }}"
                    target="_blank"
                    class="px-3 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-lg flex items-center gap-2 shadow-md"
                    title="Compartir en Twitter/X">

                    <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision"
                        text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd"
                        clip-rule="evenodd" viewBox="0 0 512 462.799"
                        style="fill: currentColor;transform: ;msFilter:;" class="size-4">
                        <path fill-rule="nonzero"
                            d="M403.229 0h78.506L310.219 196.04 512 462.799H354.002L230.261 301.007 88.669 462.799h-78.56l183.455-209.683L0 0h161.999l111.856 147.88L403.229 0zm-27.556 415.805h43.505L138.363 44.527h-46.68l283.99 371.278z" />
                    </svg>
                </a>

                {{-- Copiar Link --}}
                <div class="relative">
                    <button title="Copiar enlace" type="button" id="copy-link-button"
                        class="cursor-pointer px-2 py-1 bg-amber-500 hover:bg-amber-600 text-white rounded-lg flex items-center gap-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </button>
                    <div id="copy-tooltip"
                        class="absolute hidden bg-gray-800 text-white text-xs rounded py-1 px-2 -top-10 left-1/2 -translate-x-1/2 transition-opacity duration-300">
                        ¡Enlace copiado!
                    </div>
                </div>
            </div>
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
            <div
                class="flex col-span-full lg:col-span-1 items-center gap-3 bg-white rounded-xl shadow-md px-4 py-3 border border-gray-100">
                <div class="p-2 rounded-lg bg-red-100 text-red-600 text-xl mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-700">Reportar publicación</p>
                    <p class="text-xs text-gray-500">
                        Reporta esta publicación, si consideras que no es adecuada o no cumple con los requisitos, para
                        que un moderador pueda revisarla.
                    </p>
                </div>
            </div>
        </div>
    @else
        <div
            class="flex col-span-full justify-center text-2xl items-center gap-3 bg-lime-600 text-white rounded-md px-2 py-1.5 border border-lime-500 w-full">
            ¡Caso resuelto!
            <svg xmlns="http://www.w3.org/2000/svg" class="size-7" width="24" height="24"
                viewBox="0 0 24 24" style="fill: currentColor;msFilter:;">
                <path
                    d="M18 8.31c-.36-.41-.73-.82-1.12-1.21l-.29-.27.14-.12a3.15 3.15 0 0 0 .9-3.49A3.91 3.91 0 0 0 14 1v2a2 2 0 0 1 1.76 1c.17.4 0 .84-.47 1.31-.07.08-.15.13-.22.2-3-2.41-6.29-3.77-7.9-2.16a2.16 2.16 0 0 0-.41.59v.1l-.18.53-4.41 13.1A3.28 3.28 0 0 0 5.28 22a3.21 3.21 0 0 0 1-.17L20 17.28a1 1 0 0 0 .43-.31l.21-.18c1.43-1.44.51-4.21-1.41-6.9A6.63 6.63 0 0 1 23 9V7a8.44 8.44 0 0 0-5 1.31zM5.7 19.93a1.29 1.29 0 0 1-1.63-1.63l1.36-4.1a10.7 10.7 0 0 0 4.29 4.39zm7-2.33a8.87 8.87 0 0 1-6.3-6.29l1-3 .06.09c.11.22.25.45.39.68s.16.29.26.44.33.48.51.73.19.28.3.42.43.55.66.82l.29.35c.34.39.7.77 1.08 1.16s.68.64 1 1l.33.28.78.63.37.28c.28.2.55.4.83.58l.31.2c.36.22.72.43 1.07.61h.05zm6.51-2.23h-.06c-.69.38-3.56-.57-6.79-3.81-.34-.34-.66-.67-.95-1l-.29-.35-.53-.64-.29-.4c-.13-.19-.27-.37-.39-.55l-.26-.42-.29-.47c-.08-.14-.14-.27-.21-.4s-.15-.26-.21-.4a3.31 3.31 0 0 1-.14-.36c-.05-.13-.11-.26-.15-.38S8.6 6 8.57 5.88s-.05-.22-.07-.32a2.26 2.26 0 0 1 0-.26 1 1 0 0 1 0-.24l.11-.31c.36-.36 2.23 0 4.73 1.9A4.13 4.13 0 0 1 12 7v2a6.45 6.45 0 0 0 3-.94l.48.46c.42.42.81.85 1.18 1.28a5.32 5.32 0 0 0-.6 3.4l2-.39a3.57 3.57 0 0 1 0-1.12 11.3 11.3 0 0 1 .81 1.45c.56 1.32.52 2.06.34 2.23z">
                </path>
            </svg>
        </div>
    @endif

    {{-- Botón volver --}}
    <div class="grid grid-cols-1 md:grid-cols-2 justify-items-center gap-3 mt-6">
        @auth
            @if ($post->user_id == auth()->user()->id)
                <a href="/admin/posts?tableAction=edit&tableActionRecord={{ $post->id }}"
                    class="justify-center bg-amber-500 text-white text-sm px-3 py-1.5 rounded-lg hover:-translate-y-0.5 transition inline-flex items-center gap-2 w-full sm:w-fit">
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

        {{-- El botón de reporte se muestra a todos, excepto al dueño del post --}}
        @if (Auth::guest() || (Auth::check() && $post->user_id != auth()->user()->id))
            @if ($hasReported)
                <button type="button" disabled
                    class="flex items-center gap-2 bg-gray-400 text-white rounded-lg px-3 py-1.5 w-full sm:w-fit justify-center cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Reporte enviado
                </button>
            @else
                <button type="button" wire:click="reportPost" wire:loading.attr="disabled"
                    class="cursor-pointer flex items-center gap-2 bg-red-600 text-white rounded-lg px-3 py-1.5 hover:-translate-y-0.5 transition w-full sm:w-fit justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <span wire:loading.remove wire:target="reportPost">Reportar publicación</span>
                    <span wire:loading wire:target="reportPost">Enviando...</span>
                </button>
            @endif
        @endif

        <div class="w-full inline-flex items-center justify-center text-center">
            <a href="{{ route('unresolved') }}"
                class="flex items-center gap-2 bg-gray-200 text-gray-800 rounded-lg px-3 py-1.5 hover:-translate-y-0.5 transition w-full sm:w-fit justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                Volver a publicaciones
            </a>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function initializeCopyButton() {
            const copyButton = document.getElementById('copy-link-button');
            const tooltip = document.getElementById('copy-tooltip');

            if (copyButton && !copyButton.dataset.initialized) {
                copyButton.dataset.initialized = true;
                copyButton.addEventListener('click', function() {
                    const urlToCopy = '{{ route('post', $post) }}';

                    navigator.clipboard.writeText(urlToCopy).then(() => {
                        tooltip.classList.remove('hidden');
                        setTimeout(() => tooltip.classList.add('hidden'), 2000);
                    }).catch(err => console.error('Error al copiar el enlace: ', err));
                });
            }
        }

        document.addEventListener('DOMContentLoaded', initializeCopyButton);
        document.addEventListener('livewire:navigated', initializeCopyButton);
    </script>
@endpush
