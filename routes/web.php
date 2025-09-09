<?php

use App\Models\Posts;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // Obtenemos los últimos 5 posts publicados para pasarlos a la vista.
    $posts = Posts::where('is_published', true)->latest()->take(5)->get();

    return view('welcome', ['posts' => $posts]);
})->name('home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');
