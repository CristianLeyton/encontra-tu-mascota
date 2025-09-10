<?php

namespace App\Livewire;

use App\Models\Posts;
use App\Models\Reports;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Post extends Component
{

    public $post;
    public bool $hasReported = false;

    public function mount($post)
    {
        $this->post = $post;
        if (Auth::check()) {
            // Para usuarios logueados, verificamos si ESE usuario ya reportó.
            $this->hasReported = Reports::where('post_id', $this->post->id)
                ->where('user_id', Auth::id())
                ->exists();
        } else {
            // Para invitados, verificamos si CUALQUIER invitado ya reportó.
            $this->hasReported = Reports::where('post_id', $this->post->id)
                ->whereNull('user_id')
                ->exists();
        }
    }

    public function reportPost()
    {
        // El dueño del post no puede reportarlo.
        if (Auth::check() && Auth::id() == $this->post->user_id) {
            return;
        }

        // Si ya se ha reportado (por este usuario o por un invitado), no hacer nada.
        if ($this->hasReported) {
            return;
        }

        Reports::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(), // Devuelve el ID del usuario o null si es invitado.
        ]);

        $this->hasReported = true;
    }


    public function render()
    {
        return view('livewire.post');
    }
}
