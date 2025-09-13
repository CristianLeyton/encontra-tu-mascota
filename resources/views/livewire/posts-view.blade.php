<div>
    <div class="grid grid-cols-1 gap-4 p-4 container mx-auto mt-18">
        {{-- Panel de filtros --}}
        <div
            class="w-full col-span-full grid grid-cols-2 gap-4 p-4 rounded-xl shadow-md text-slate-600 h-fit text-xs border border-gray-100 ">

            <div class="">
                <label class="block mb-1 font-medium">Buscar por:</label>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Buscar título/descr."
                        class="border border-gray-400 outline-emerald-600 rounded-lg px-2 py-[7px] w-full col-span-full">
                    <input type="text" wire:model.live.debounce.500ms="color" placeholder="Color"
                        class="border border-gray-400 outline-emerald-600 rounded-lg px-2 py-[7px] w-full">

                    <input type="text" wire:model.live.debounce.500ms="location" placeholder="Ubicación aproximada"
                        class="border border-gray-400 outline-emerald-600 rounded-lg px-2 py-[7px] w-full">
                </div>

                <label class="block mt-2 mb-1 font-medium">Filtrar por fecha:</label>
                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="block mb-1  font-medium">Desde:</label>
                        <input type="date" wire:model.live="date_from"
                            class="border border-gray-400 outline-emerald-600 rounded-lg px-2 py-[7px] w-full">
                    </div>
                    <div>
                        <label class="block mb-1  font-medium">Hasta:</label>
                        <input type="date" wire:model.live="date_to"
                            class="border border-gray-400 outline-emerald-600 rounded-lg px-2 py-[7px] w-full">
                    </div>
                </div>

            </div>

            <div>
                <label class="block mb-1 font-medium">Filtrar por:</label>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                    <select wire:model.live="is_missing"
                        class="border border-gray-400 outline-emerald-600 rounded-lg px-2 py-1.5 w-full">
                        <option value="">Todos</option>
                        <option value="1">Perdido</option>
                        <option value="0">Encontrado</option>
                    </select>

                    <select wire:model.live="species_id"
                        class="border border-gray-400 outline-emerald-600 rounded-lg px-2  py-1.5 w-full">
                        <option value="">Todas las especies</option>
                        @foreach ($speciesList as $species)
                            <option value="{{ $species->id }}">{{ $species->name }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="breed_id"
                        class="border border-gray-400 outline-emerald-600 rounded-lg px-2  py-1.5 w-full"
                        @if (!$breedsList) disabled @endif>
                        <option value="">Todas las razas</option>
                        @foreach ($breedsList as $breed)
                            <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="size"
                        class="border border-gray-400 outline-emerald-600 rounded-lg px-2  py-1.5 w-full">
                        <option value="">Todos los tamaños</option>
                        <option value="Muy pequeño">Muy pequeño</option>
                        <option value="Pequeño">Pequeño</option>
                        <option value="Mediano">Mediano</option>
                        <option value="Grande">Grande</option>
                        <option value="Muy grande">Muy grande</option>
                    </select>
                </div>

                {{-- Botón limpiar filtros --}}
                <div class="flex justify-end mt-2.5">
                    <button wire:click="resetFilters"
                        class="bg-emerald-600 text-white rounded-lg px-3.5 py-1.5 text-xs font-semibold shadow-sm hover:bg-emerald-700 transition cursor-pointer">
                        Limpiar filtros
                    </button>
                </div>
            </div>


        </div>

        {{-- Grid de posts --}}
        <div class="w-full">

            {{-- Esqueleto de carga --}}
            <div wire:loading.grid class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6">
                @for ($i = 0; $i < 12; $i++)
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
            <div wire:loading.remove class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6">
                @forelse ($posts as $post)
                    @include('components.post-card', ['post' => $post])
                @empty
                    <div class="col-span-full text-center text-gray-500 py-10">
                        <p class="text-lg">No se encontraron publicaciones con los filtros seleccionados.</p>
                    </div>
                @endforelse
            </div>

            {{-- Paginación --}}
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>


    </div>
</div>
