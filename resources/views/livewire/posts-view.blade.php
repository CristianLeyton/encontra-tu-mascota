<div class="flex flex-col lg:flex-row gap-6 py-4">

    {{-- Panel de filtros lateral --}}
    <div class="w-full lg:w-1/4 bg-white p-4 rounded-xl shadow-md text-slate-600 h-fit text-sm border border-gray-100">
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
    <div class="w-full lg:w-3/4">
        {{-- Esqueleto de carga --}}
        <div wire:loading.grid class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-6">
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
        <div wire:loading.remove class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-6">
            @forelse ($posts as $post)
                @include('components.post-card', ['post' => $post])
            @empty
                <div class="col-span-full text-center text-gray-500 py-10">
                    <p class="text-lg">No se encontraron publicaciones con los filtros seleccionados.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $posts->links() }}
    </div>

</div>
