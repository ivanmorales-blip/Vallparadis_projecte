@extends('layouts.template')

@section('contingut')

<div class="container mx-auto px-4 py-10">
    
    <div class="flex items-center space-x-3">
        <svg class="h-11 w-11 mb-10">
            <use href="{{ asset('icons/sprite.svg#computer-desktop') }}"></use>
        </svg>

        <h1 class="text-4xl font-bold text-gray-800 mb-10">
            Panell de Gestió
        </h1>
    </div>

    <div class="grid gap-8 md:grid-cols-3">

        <!-- CARD COMPONENT (reutilizable visualmente) -->
        @php
            $cardClasses = "bg-white shadow-xl border border-gray-200 hover:shadow-2xl 
                            transition-shadow duration-300 rounded-2xl p-6 flex flex-col";
            $linkClasses = "text-[#F97800] font-medium hover:underline hover:text-orange-600";
        @endphp

        <!-- Centres -->
        <div class="{{ $cardClasses }}">

                <div class="flex items-center space-x-3">
                    <svg class="h-6 w-6 mb-6">
                        <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#centre-icone"></use>
                    </svg>

                    <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                        Centres
                    </h2>
                </div>

            <a href="{{ route('centers.index') }}" class="{{ $linkClasses }} mb-2">Listar Centres</a>
            <a href="{{ route('centers.create') }}" class="{{ $linkClasses }}">Alta Centre</a>

        </div>

        <!-- Professionals -->
        <div class="{{ $cardClasses }}">
            <div class="flex items-center space-x-3">
                    <svg class="h-6 w-6 mb-6">
                        <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#profesionals-icone"></use>
                    </svg>

                    <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                        Professionals
                    </h2>
            </div>
            <a href="{{ route('profesional.index') }}" class="{{ $linkClasses }} mb-2">Listar Professionals</a>
            <a href="{{ route('profesional.create') }}" class="{{ $linkClasses }}">Alta Professional</a>
        </div>

        <!-- Projectes -->
        <div class="{{ $cardClasses }}">
            <div class="flex items-center space-x-3">
                    <svg class="h-6 w-6 mb-6">
                        <use href="{{ asset('icons/sprite.svg#computer-desktop') }}"></use>
                    </svg>

                    <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                        Projectes
                    </h2>
            </div>
            <a href="{{ route('projectes_comissions.projectes') }}" class="{{ $linkClasses }} mb-2">Listar Projectes</a>
            <a href="{{ route('projectes_comissions.create') }}" class="{{ $linkClasses }}">Alta Projecte</a>
        </div>

        <!-- Comissions -->
        <div class="{{ $cardClasses }}">
            <div class="flex items-center space-x-3">
                    <svg class="h-6 w-6 mb-6">
                        <use href="{{ asset('icons/sprite.svg#computer-desktop') }}"></use>
                    </svg>

                    <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                        Comissions
                    </h2>
            </div>
            <a href="{{ route('projectes_comissions.comissions') }}" class="{{ $linkClasses }} mb-2">Listar Comissions</a>
            <a href="{{ route('projectes_comissions.create') }}" class="{{ $linkClasses }}">Alta Comissió</a>
        </div>

        <!-- Gestió Seguiments i Avaluacions -->
        <div class="{{ $cardClasses }}">
            <div class="flex items-center space-x-3">
                    <svg class="h-6 w-6 mb-6">
                        <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#tracking-icone"></use>
                    </svg>

                    <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                        Seguiments i Avaluacions
                    </h2>
            </div>
            <a href="{{ route('tracking.create') }}" class="{{ $linkClasses }} mb-2">
                ➕ Donar d'alta Seguiment
            </a>
            <a href="{{ route('evaluation.create') }}" class="{{ $linkClasses }}">
                ➕ Donar d'alta Avaluació
            </a>
        </div>

        <!-- Cursos -->
        <div class="{{ $cardClasses }}">
            <div class="flex items-center space-x-3">
                    <svg class="h-6 w-6 mb-6">
                        <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#training-icone"></use>
                    </svg>

                    <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                        Cursos
                    </h2>
            </div>
            <a href="{{ route('trainings.index') }}" class="{{ $linkClasses }} mb-2">Listar Cursos</a>
            <a href="{{ route('trainings.create') }}" class="{{ $linkClasses }}">Alta Curs</a>
        </div>

        <!--Recursos Humans-->
        <div class="{{ $cardClasses }}">
        <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                Recursos Humans
            </h2>
            <a href="{{ route('human_resources.index', 1) }}" class="{{ $linkClasses }} mb-2">Llistar Recursos Humans</a>
            <a href="{{ route('human_resources.create', [1, 'pendent']) }}" class="{{ $linkClasses }}">Alta Recurso Humà</a>
        </div>

        <div class="flex items-center space-x-3">
                    <svg class="h-6 w-6 mb-6">
                        <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#documentacio-icone"></use>
                    </svg>

                    <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                        Documentació interna
                    </h2>
            </div>
            <a href="{{ route('documentacio.index') }}" class="{{ $linkClasses }} mb-2">Listar Documentació</a>
            <a href="{{ route('documentacio.create') }}" class="{{ $linkClasses }}">Alta Documentació</a>
        </div>

        <!-- Gestio Manteniment -->
        <div class="{{ $cardClasses }}">
            <div class="flex items-center gap-3">
                <svg class="h-6 w-6">
                    <use href="{{ asset('icons/sprite.svg') }}?v={{ filemtime(public_path('icons/sprite.svg')) }}#manteniment-icone"></use>
                </svg>

                <h2 class="text-xl text-gray-700 font-semibold border-b pb-1">
                    Manteniment
                </h2>
            </div>

            <a href="{{ route('manteniment.index') }}" class="{{ $linkClasses }} mb-2">Listar Manteniment</a>
            <a href="{{ route('manteniment.create') }}" class="{{ $linkClasses }}">Alta Manteniment</a>
        

    </div>
</div>

@endsection
