@php
    $user = Auth::user();
@endphp

@extends('layouts.layout')

@section('titulo', 'Encontrá tu mascota')

@section('contenido')
    @if (!$user)
        <p class="text-center text-slate-500 text-sm pt-4">
            <a href="{{ url('/admin') }}" class="text-amber-600">Entrá a tu cuenta</a> para crear o editar publicaciones.
        </p>
    @endif
    @livewire('posts-view')
@endsection
