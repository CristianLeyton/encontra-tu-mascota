                <div
                    class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col justify-between">

                    <div class="flex justify-between items-center text-sm text-gray-500 p-4">
                        @if ($post->is_missing)
                            <span
                                class="flex items-center gap-1 px-2 py-1 rounded-md border border-red-600 text-red-600">
                                Perdido
                            </span>
                        @else
                            <span
                                class="flex items-center gap-1 px-2 py-1 rounded-md border border-cyan-600 text-cyan-600">
                                Encontrado
                            </span>
                        @endif
                        <a href="{{ $post->location ? 'https://www.google.com/maps/search/' . urlencode($post->location) : null }}"
                            class="flex items-center gap-1  px-2 py-1 rounded-md border border-lime-600 text-lime-600 hover:bg-lime-600 hover:text-white transition-colors"
                            target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            {{ $post->location ?? 'Ubicación aproximada' }}
                        </a>
                    </div>

                    @php
                        $images = is_array($post->images) ? $post->images : json_decode($post->images, true);
                    @endphp

                    @if (!empty($images) && isset($images[0]))
                        <img src="{{ asset('/storage_public/' . $images[0]) }}" alt="{{ $post->title }}"
                            class="w-full aspect-video object-contain mt-4">
                    @else
                        {{-- Placeholder si no hay imágenes --}}
                        <div class="aspect-video bg-gray-200 flex items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="fill: currentColor;transform: ;msFilter:;" class="size-48">
                                <path
                                    d="M19.999 4h-16c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-13.5 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm5.5 10h-7l4-5 1.5 2 3-4 5.5 7h-7z">
                                </path>
                            </svg>
                        </div>
                    @endif

                    {{-- Contenido --}}
                    <div class="p-4 flex flex-col gap-1">
                        <h2 class="text-xl font-semibold text-gray-800 line-clamp-1">
                            {{ $post->title }}
                        </h2>
                        {{-- Información extra de la mascota --}}
                        <div class="flex text-sm text-gray-600 gap-1">
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

                        <div
                            class="grid md:grid-cols-2 align-items-center justify-items-center text-sm text-gray-600 border rounded-md border-gray-300 p-2 gap-2">
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                {{ $post->name_contact ?? 'Anónimo' }}
                            </span>

                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>

                                {{ $post->created_at->format('d/m/Y') }}
                            </span>

                            @if ($post->email_contact)
                                <a href="mailto:{{ $post->email_contact }}"
                                    class="flex items-center gap-1.5 text-cyan-600" target="_blank">
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


                        {{-- Botón --}}
                        <div class="flex items-center w-full">
                            <a href="{{ url('/posts/' . $post->slug) }}"
                                class="mt-3 w-full justify-center bg-amber-600 text-white text-sm px-3 py-1.5 rounded-lg hover:bg-amber-700 transition inline-flex items-center gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;">
                                    <path
                                        d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z">
                                    </path>
                                    <path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path>
                                </svg>
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
