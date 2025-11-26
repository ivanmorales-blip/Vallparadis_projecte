@extends('layouts.template')

@section('contingut')

<div class="container mx-auto px-4 py-10">
    
    <h1 class="text-4xl font-bold text-gray-800 mb-10">
        📊 Panell de Gestió
    </h1>

    <div class="grid gap-8 md:grid-cols-3">

        <!-- CARD COMPONENT (reutilizable visualmente) -->
        @php
            $cardClasses = "bg-white shadow-xl border border-gray-200 hover:shadow-2xl 
                            transition-shadow duration-300 rounded-2xl p-6 flex flex-col";
            $linkClasses = "text-[#F97800] font-medium hover:underline hover:text-orange-600";
        @endphp

        <!-- Centres -->
        <div class="{{ $cardClasses }}">
            <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                🏥 Centres
            </h2>
            <a href="{{ route('centers.index') }}" class="{{ $linkClasses }} mb-2">Listar Centres</a>
            <a href="{{ route('centers.create') }}" class="{{ $linkClasses }}">Alta Centre</a>
        </div>

        <!-- Professionals -->
        <div class="{{ $cardClasses }}">
            <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                👤 Professionals
            </h2>
            <a href="{{ route('profesional.index') }}" class="{{ $linkClasses }} mb-2">Listar Professionals</a>
            <a href="{{ route('profesional.create') }}" class="{{ $linkClasses }}">Alta Professional</a>
        </div>

        <!-- Projectes -->
        <div class="{{ $cardClasses }}">
            <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                📁 Projectes
            </h2>
            <a href="{{ route('projectes_comissions.projectes') }}" class="{{ $linkClasses }} mb-2">Listar Projectes</a>
            <a href="{{ route('projectes_comissions.create') }}" class="{{ $linkClasses }}">Alta Projecte</a>
        </div>

        <!-- Comissions -->
        <div class="{{ $cardClasses }}">
            <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                🧩 Comissions
            </h2>
            <a href="{{ route('projectes_comissions.comissions') }}" class="{{ $linkClasses }} mb-2">Listar Comissions</a>
            <a href="{{ route('projectes_comissions.create') }}" class="{{ $linkClasses }}">Alta Comissió</a>
        </div>

        <!-- Gestió Seguiments i Avaluacions -->
        <div class="{{ $cardClasses }}">
            <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                📑 Seguiments & Avaluacions
            </h2>
            <a href="{{ route('tracking.create') }}" class="{{ $linkClasses }} mb-2">
                ➕ Donar d'alta Seguiment
            </a>
            <a href="{{ route('evaluation.create') }}" class="{{ $linkClasses }}">
                ➕ Donar d'alta Avaluació
            </a>
        </div>

        <!-- Cursos -->
        <div class="{{ $cardClasses }}">
            <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                🎓 Cursos
            </h2>
            <a href="{{ route('trainings.index') }}" class="{{ $linkClasses }} mb-2">Listar Cursos</a>
            <a href="{{ route('trainings.create') }}" class="{{ $linkClasses }}">Alta Curs</a>
        </div>

        <!-- Gestio Documentació interna -->
        <div class="{{ $cardClasses }}">
            <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                Documentació Interna
            </h2>
            <a href="{{ route('documentacio.index') }}" class="{{ $linkClasses }} mb-2">Listar Documentació</a>
            <a href="{{ route('documentacio.create') }}" class="{{ $linkClasses }}">Alta Documentació</a>
        </div>

        <!-- Gestio Manteniment -->
        <div class="{{ $cardClasses }}">
            <h2 class="text-xl flex items-center gap-2 text-gray-700 font-semibold mb-4 pb-2 border-b">
                Manteniment
            </h2>
            <a href="{{ route('manteniment.index') }}" class="{{ $linkClasses }} mb-2">Listar Manteniment</a>
            <a href="{{ route('manteniment.create') }}" class="{{ $linkClasses }}">Alta Manteniment</a>
        </div>

    </div>
</div>

@endsection
