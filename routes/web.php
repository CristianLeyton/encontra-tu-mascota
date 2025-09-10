<?php

use App\Models\Posts;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/resueltos', function () {
    return view('resolved');
})->name('resolved');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');
