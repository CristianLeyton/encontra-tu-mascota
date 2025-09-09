<?php

use App\Models\Posts;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Obtenemos los últimos 5 posts publicados para pasarlos a la vista.
    $posts = Posts::where('is_published', true)->latest()->take(5)->get();

    return view('welcome', ['posts' => $posts]);
});
