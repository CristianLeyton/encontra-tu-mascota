@php
    $user = Auth::user();
@endphp

@extends('layouts.layout')

@section('titulo', 'Mascotas encontradas')

@section('contenido')
    @if (!$user)
        <p class="text-center text-slate-500 text-sm pt-22 -mb-18 bg-gray-50">
            <a href="{{ url('/admin') }}" class="text-emerald-500 font-semibold">Entrá a tu cuenta</a> para crear o editar publicaciones.
        </p>
    @endif
    @livewire('posts-view-resolved')
@endsection
