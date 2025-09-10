<?php

namespace App\Livewire;

use App\Models\Posts;
use App\Models\Species;
use App\Models\Breeds;
use Livewire\Component;
use Livewire\WithPagination;

class PostsViewResolved extends Component
{
    use WithPagination;

    public $search = null;
    public $is_missing = null;
    public $species_id = null;
    public $breed_id = null;
    public $color = null;
    public $location = null;
    public $size = null;
    public $date_from = null;
    public $date_to = null;

    public $speciesList;
    public $breedsList = [];

    public function mount()
    {
        $this->speciesList = Species::orderBy('name')->get();
        $this->breedsList = [];
    }

    // 🔄 Este método se ejecuta automáticamente cuando cambia $species_id
    public function updatedSpeciesId($value)
    {
        $this->resetPage();
        if ($value) {
            $this->breedsList = Breeds::where('species_id', $value)->orderBy('name')->get();
        }
        $this->breed_id = null; // Resetea la raza seleccionada
    }

    public function render()
    {
        $postsResolved = Posts::query()->where('is_published', true)->where('is_resolved', true)->count();
        $totalPosts = Posts::query()->where('is_published', true)->count();
        $totalPostsUnresolvedMissed = Posts::query()->where('is_published', true)->where('is_resolved', false)->where('is_missing', true)->count();
        $totalPostsUnresolvedFounded = Posts::query()->where('is_published', true)->where('is_resolved', false)->where('is_missing', false)->count();

        $query = Posts::query()
            ->where('is_published', true)
            ->where('is_resolved', true)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            }) // 👈 Se agrupa la búsqueda de texto
            ->when(isset($this->is_missing) && $this->is_missing !== '', fn($q) => $q->where('is_missing', $this->is_missing))
            ->when($this->species_id, fn($q) => $q->where('species_id', $this->species_id))
            ->when($this->breed_id, fn($q) => $q->where('breed_id', $this->breed_id))
            ->when($this->color, fn($q) => $q->where('color', 'like', '%' . $this->color . '%'))
            ->when($this->size, fn($q) => $q->where('size', $this->size))
            ->when($this->date_from, fn($q) => $q->whereDate('created_at', '>=', $this->date_from))
            ->when($this->date_to, fn($q) => $q->whereDate('created_at', '<=', $this->date_to))
            ->when($this->location, function ($query) {
                $query->where('location', 'like', '%' . $this->location . '%');
            });

        return view('livewire.posts-view-resolved', [
            'posts' => $query->latest()->paginate(12),
            'postsResolved' => $postsResolved,
            'totalPosts' => $totalPosts,
            'totalPostsUnresolvedMissed' => $totalPostsUnresolvedMissed,
            'totalPostsUnresolvedFounded' => $totalPostsUnresolvedFounded,
        ]);
    }
}
