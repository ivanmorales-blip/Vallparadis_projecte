@extends('layouts.template')

@section('contingut')
<div class="container mx-auto px-4 py-12">

    <!-- Header -->
    <div class="flex items-center space-x-4 mb-12">
        <svg class="h-12 w-12 text-gray-600">
            <use href="{{ asset('icons/sprite.svg#computer-desktop') }}"></use>
        </svg>
        <h1 class="text-4xl font-extrabold text-gray-800">Panell de Gestió</h1>
    </div>

    <!-- Grid Cards -->
    <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

        @php
            $cardBase = "bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-6 flex flex-col";
            $linkBase = "text-orange-500 font-medium hover:underline hover:text-orange-600 transition-colors duration-200";
        @endphp

        <!-- Centres -->
        <div class="{{ $cardBase }}">
            <div class="flex items-center mb-4">
                <svg class="h-6 w-6 text-gray-600 mr-2">
                    <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#centre-icone"></use>
                </svg>
                <h2 class="text-lg font-semibold text-gray-700">Centres</h2>
            </div>
            <a href="{{ route('centers.index') }}" class="{{ $linkBase }} mb-2">Listar Centres</a>
            <a href="{{ route('centers.create') }}" class="{{ $linkBase }}">Alta Centre</a>
        </div>

        <!-- Professionals -->
        <div class="{{ $cardBase }}">
            <div class="flex items-center mb-4">
                <svg class="h-6 w-6 text-gray-600 mr-2">
                    <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#profesionals-icone"></use>
                </svg>
                <h2 class="text-lg font-semibold text-gray-700">Professionals</h2>
            </div>
            <a href="{{ route('profesional.index') }}" class="{{ $linkBase }} mb-2">Listar Professionals</a>
            <a href="{{ route('profesional.create') }}" class="{{ $linkBase }}">Alta Professional</a>
        </div>

        <!-- Projectes -->
        <div class="{{ $cardBase }}">
            <div class="flex items-center mb-4">
                <svg class="h-6 w-6 text-gray-600 mr-2">
                    <use href="{{ asset('icons/sprite.svg#computer-desktop') }}"></use>
                </svg>
                <h2 class="text-lg font-semibold text-gray-700">Projectes</h2>
            </div>
            <a href="{{ route('projectes_comissions.projectes') }}" class="{{ $linkBase }} mb-2">Listar Projectes</a>
            <a href="{{ route('projectes_comissions.create') }}" class="{{ $linkBase }}">Alta Projecte</a>
        </div>

        <!-- Comissions -->
        <div class="{{ $cardBase }}">
            <div class="flex items-center mb-4">
                <svg class="h-6 w-6 text-gray-600 mr-2">
                    <use href="{{ asset('icons/sprite.svg#computer-desktop') }}"></use>
                </svg>
                <h2 class="text-lg font-semibold text-gray-700">Comissions</h2>
            </div>
            <a href="{{ route('projectes_comissions.comissions') }}" class="{{ $linkBase }} mb-2">Listar Comissions</a>
            <a href="{{ route('projectes_comissions.create') }}" class="{{ $linkBase }}">Alta Comissió</a>
        </div>

        <!-- Seguiments i Avaluacions -->
        <div class="{{ $cardBase }}">
            <div class="flex items-center mb-4">
                <svg class="h-6 w-6 text-gray-600 mr-2">
                    <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#tracking-icone"></use>
                </svg>
                <h2 class="text-lg font-semibold text-gray-700">Seguiments i Avaluacions</h2>
            </div>
            <a href="{{ route('tracking.create') }}" class="{{ $linkBase }} mb-2">Donar d'alta Seguiment</a>
            <a href="{{ route('evaluation.create') }}" class="{{ $linkBase }}">Donar d'alta Avaluació</a>
        </div>

        <!-- Cursos -->
        <div class="{{ $cardBase }}">
            <div class="flex items-center mb-4">
                <svg class="h-6 w-6 text-gray-600 mr-2">
                    <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#training-icone"></use>
                </svg>
                <h2 class="text-lg font-semibold text-gray-700">Cursos</h2>
            </div>
            <a href="{{ route('trainings.index') }}" class="{{ $linkBase }} mb-2">Listar Cursos</a>
            <a href="{{ route('trainings.create') }}" class="{{ $linkBase }}">Alta Curs</a>
        </div>

        <!-- Recursos Humans -->
        <div class="{{ $cardBase }}">
            <div class="flex items-center mb-4">
                <svg class="h-6 w-6 text-gray-600 mr-2">
                    <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#human-resources-icone"></use>
                </svg>
                <h2 class="text-lg font-semibold text-gray-700">Recursos Humans</h2>
            </div>
            <a href="{{ route('human_resources.index', 1) }}" class="{{ $linkBase }} mb-2">Llistar Recursos Humans</a>
            <a href="{{ route('human_resources.create', [1, 'pendent']) }}" class="{{ $linkBase }}">Alta Recurso Humà</a>
        </div>

        <!-- Documentació interna -->
        <div class="{{ $cardBase }}">
            <div class="flex items-center mb-4">
                <svg class="h-6 w-6 text-gray-600 mr-2">
                    <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#documentacio-icone"></use>
                </svg>
                <h2 class="text-lg font-semibold text-gray-700">Documentació interna</h2>
            </div>
            <a href="{{ route('documentacio.index') }}" class="{{ $linkBase }} mb-2">Listar Documentació</a>
            <a href="{{ route('documentacio.create') }}" class="{{ $linkBase }}">Alta Documentació</a>
        </div>

        <!-- Manteniment -->
        <div class="{{ $cardBase }}">
            <div class="flex items-center mb-4">
                <svg class="h-6 w-6 text-gray-600 mr-2">
                    <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#manteniment-icone"></use>
                </svg>
                <h2 class="text-lg font-semibold text-gray-700">Manteniment</h2>
            </div>
            <a href="{{ route('manteniment.index') }}" class="{{ $linkBase }} mb-2">Listar Manteniment</a>
            <a href="{{ route('manteniment.create') }}" class="{{ $linkBase }}">Alta Manteniment</a>
        </div>

    </div>
</div>
@endsection
