@php
    $user = Auth::user();
@endphp

@extends('layouts.layout')

@section('titulo', 'Mascotas encontradas')

@section('contenido')
    @if (!$user)
        <p class="text-center text-slate-500 pt-4 text-sm mt-18 -mb-18">
            <a href="{{ url('/admin') }}" class="text-emerald-500 font-semibold">Entrá a tu cuenta</a> para crear o editar publicaciones.
        </p>
    @endif
    @livewire('posts-view-resolved')
@endsection
