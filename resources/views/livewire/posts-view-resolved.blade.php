<div>
    {{-- Estadisticas --}}
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 py-4">

        {{-- Total de publicaciones --}}
        <div class="flex items-center gap-3 bg-white rounded-xl shadow-md px-3 py-1.5 border border-gray-100">
            <div class="p-2 rounded-lg bg-indigo-100 text-indigo-600">
                {{-- Icono de lista --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                </svg>

            </div>
            <div>
                <p class="text-xs text-gray-500">Publicaciones</p>
                <p class="text-lg font-semibold text-gray-700">{{ $totalPosts }}</p>
            </div>
        </div>

        {{-- Publicados como perdidos --}}
        <div class="flex items-center gap-3 bg-white rounded-xl shadow-md px-3 py-1.5 border border-gray-100">
            <div class="p-2 rounded-lg bg-red-100 text-red-600">
                {{-- Icono de alerta --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500">Perdidos</p>
                <p class="text-lg font-semibold text-gray-700">{{ $totalPostsUnresolvedMissed }}</p>
            </div>
        </div>

        {{-- Publicados como encontrados --}}
        <div class="flex items-center gap-3 bg-white rounded-xl shadow-md px-3 py-1.5 border border-gray-100">
            <div class="p-2 rounded-lg bg-cyan-100 text-cyan-600">
                {{-- Icono de ojo --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.639 0 8.577 3.01 9.964 7.183a1.012 1.012 0 0 1 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500">Encontrados</p>
                <p class="text-lg font-semibold text-gray-700">{{ $totalPostsUnresolvedFounded }}</p>
            </div>
        </div>

                {{-- Casos resueltos --}}
        <div class="flex items-center gap-3 bg-white rounded-xl shadow-md px-3 py-1.5 border border-gray-100">
            <div class="p-2 rounded-lg bg-green-100 text-green-600">
                {{-- Icono check --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                </svg>

            </div>
            <div>
                <p class="text-xs text-gray-500">Casos resueltos</p>
                <p class="text-lg font-semibold text-gray-700">{{ $postsResolved }}</p>
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 py-2">
        {{-- Panel de filtros lateral --}}
        <div
            class="w-full sm:col-span-2 md:col-span-1 bg-white p-4 rounded-xl shadow-md text-slate-600 h-fit text-sm border border-gray-100">
            <label class="block mb-2 text-sm font-medium">Buscar por:</label>

            <input type="text" wire:model.live.debounce.500ms="search" placeholder="Buscar título/descr."
                class="border border-gray-500 outline-amber-600 rounded-lg px-2  py-1.5 mb-2 w-full">

            <input type="text" wire:model.live.debounce.500ms="color" placeholder="Color"
                class="border border-gray-500 outline-amber-600 rounded-lg px-2  py-1.5 mb-2 w-full">

            <input type="text" wire:model.live.debounce.500ms="location" placeholder="Ubicación aproximada"
                class="border border-gray-500 outline-amber-600 rounded-lg px-2  py-1.5 mb-2 w-full">

            <label class="block mb-2 text-sm font-medium">Filtrar por:</label>

            <select wire:model.live="is_missing"
                class="border border-gray-500 outline-amber-600 rounded-lg px-2  py-1.5 mb-2 w-full">
                <option value="">Todos</option>
                <option value="1">Perdido</option>
                <option value="0">Encontrado</option>
            </select>

            <select wire:model.live="species_id"
                class="border border-gray-500 outline-amber-600 rounded-lg px-2  py-1.5 mb-2 w-full">
                <option value="">Todas las especies</option>
                @foreach ($speciesList as $species)
                    <option value="{{ $species->id }}">{{ $species->name }}</option>
                @endforeach
            </select>

            <select wire:model.live="breed_id"
                class="border border-gray-500 outline-amber-600 rounded-lg px-2  py-1.5 mb-2 w-full"
                @if (!$breedsList) disabled @endif>
                <option value="">Todas las razas</option>
                @foreach ($breedsList as $breed)
                    <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                @endforeach
            </select>

            <select wire:model.live="size"
                class="border border-gray-500 outline-amber-600 rounded-lg px-2  py-1.5 mb-2 w-full">
                <option value="">Todos los tamaños</option>
                <option value="Muy pequeño">Muy pequeño</option>
                <option value="Pequeño">Pequeño</option>
                <option value="Mediano">Mediano</option>
                <option value="Grande">Grande</option>
                <option value="Muy grande">Muy grande</option>
            </select>

            <label class="block mb-2 text-sm font-medium">Fecha desde:</label>
            <input type="date" wire:model.live="date_from"
                class="border border-gray-500 outline-amber-600 rounded-lg px-2  py-1.5 mb-2 w-full">

            <label class="block mb-2 text-sm font-medium">Fecha hasta:</label>
            <input type="date" wire:model.live="date_to"
                class="border border-gray-500 outline-amber-600 rounded-lg px-3 py-2 w-full">
        </div>

        {{-- Grid de posts --}}
        <div class="w-full sm:col-span-2 md:col-span-1 lg:col-span-3 xl:col-span-3">
            {{-- Esqueleto de carga --}}
            <div wire:loading.grid class="grid lg:grid-cols-2 2xl:grid-cols-3 gap-6">
                @for ($i = 0; $i < 6; $i++)
                    <div
                        class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 flex flex-col justify-between animate-pulse">
                        <div class="p-4">
                            <div class="flex justify-between items-center text-sm">
                                <div class="h-5 bg-gray-300 rounded w-20"></div>
                                <div class="h-5 bg-gray-300 rounded w-32"></div>
                            </div>
                        </div>
                        <div class="aspect-video bg-gray-300 w-full"></div>
                        <div class="p-4 flex flex-col gap-3">
                            <div class="h-6 bg-gray-300 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-300 rounded w-full"></div>
                            <div class="h-4 bg-gray-300 rounded w-5/6"></div>
                            <div class="mt-2 h-9 bg-gray-300 rounded-lg w-full"></div>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- Contenido real --}}
            <div wire:loading.remove class="grid lg:grid-cols-2 2xl:grid-cols-3 gap-6">
                @forelse ($posts as $post)
                    @include('components.post-card', ['post' => $post])
                @empty
                    <div class="col-span-full text-center text-gray-500 py-10">
                        <p class="text-lg">No se encontraron publicaciones con los filtros seleccionados.</p>
                    </div>
                @endforelse
            </div>

            {{-- Paginación --}}
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>

    </div>


</div>
