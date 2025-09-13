@php
    $user = Auth::user();
@endphp

@extends('layouts.layout')

@php
    // Aseguramos que $post->images sea array
    $images = is_array($post->images) ? $post->images : (array) $post->images;
    $firstImage = $images[0] ?? null;

    $imageUrl = $firstImage ? asset('storage_public/' . $firstImage) : asset('images/default-share.png'); // fallback
@endphp

@section('head')
    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $post->title }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($post->description), 150) }}" />
    <meta property="og:image" content="{{ $imageUrl }}" />
    <meta property="og:url" content="{{ route('post', $post) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="es_AR" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($post->description), 150) }}">
    <meta name="twitter:image" content="{{ $imageUrl }}">
@endsection

@section('titulo', ($post->is_missing ? 'Mascota perdida' : 'Mascota encontrada') . ': ' . $post->title)
@section('descripcion', $post->description)

@section('contenido')
    @if (!$user)
        <p class="text-center text-slate-500 bg-gray-50 pt-22 text-sm -mb-18">
            <a href="{{ url('/admin') }}" class="text-emerald-500 font-semibold">Entrá a tu cuenta</a> para crear o editar publicaciones.
        </p>
    @endif
    @livewire('post', ['post' => $post])
@endsection
