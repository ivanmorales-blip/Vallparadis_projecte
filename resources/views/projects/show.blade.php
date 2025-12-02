@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-b from-gray-100 via-gray-50 to-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl p-10 border border-gray-200/50 relative">

        <!-- Título y etiqueta -->
        <div class="flex justify-between items-start mb-10">
            <h1 class="text-4xl font-extrabold text-orange-500 tracking-tight leading-tight">
                {{ $projecte->nom }}
            </h1>

            <div class="ml-4 flex items-center">
                <span class="bg-purple-100 text-purple-800 px-5 py-2 rounded-full font-semibold text-sm shadow-lg animate-pulse">
                    Projecte
                </span>
            </div>
        </div>

        <!-- Datos principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 mb-12">

            <!-- Card izquierda -->
            <div class="p-5 bg-gray-50 rounded-xl shadow-inner border border-gray-200">
                <p class="font-semibold text-gray-900">Data d'inici</p>
                <p class="mb-5 text-gray-700">
                    {{ \Carbon\Carbon::parse($projecte->data_inici)->format('d/m/Y') }}
                </p>

                <p class="font-semibold text-gray-900">Professional responsable</p>
                <p class="text-gray-700">
                    {{ $projecte->profesional->nom ?? '—' }} {{ $projecte->profesional->cognom ?? '' }}
                </p>
            </div>

            <!-- Card derecha -->
            <div class="p-5 bg-gray-50 rounded-xl shadow-inner border border-gray-200">
                <p class="font-semibold text-gray-900">Centre</p>
                <p class="mb-5 text-gray-700">
                    {{ $projecte->centre->nom ?? '—' }}
                </p>

                <p class="font-semibold text-gray-900">Descripció</p>
                <p class="mb-5 text-gray-700">
                    {{ $projecte->descripcio ?? '—' }}
                </p>

                <p class="font-semibold text-gray-900">Observacions</p>
                <p class="text-gray-700">
                    {{ $projecte->observacions ?? '—' }}
                </p>
            </div>
        </div>

        <!-- Sección Professionals assignats -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">
                Professionals assignats
            </h2>

            @if (is_null($projecte->profesional))
                <p class="text-gray-500 italic">No hi ha professionals assignats a aquest projecte.</p>
            @else
                <ul class="space-y-3 max-h-96 overflow-y-auto scrollbar-thin scrollbar-thumb-purple-400 scrollbar-track-gray-200 pr-2">
                    <li class="p-4 bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-xl transition-all duration-300">
                        <p class="font-semibold text-gray-900">
                            {{ $projecte->profesional->nom }} {{ $projecte->profesional->cognom }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $projecte->profesional->email }}
                        </p>
                    </li>
                </ul>
            @endif
        </div>

        <!-- Botones finales -->
        <div class="flex flex-wrap justify-between gap-4 mt-10">

            <!-- Volver -->
            <a href="{{ route('projectes_comissions.projectes') }}" 
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-2xl shadow-lg 
                      transition-all transform hover:-translate-y-0.5 hover:scale-105">
                Tornar al llistat
            </a>

            <!-- Afegir Professionals -->
            <a href="{{ route('projectes_comissions.addProfessionals', $projecte->id) }}"
               class="px-6 py-3 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 
                      text-white font-bold rounded-2xl shadow-xl transition-all transform hover:-translate-y-1 hover:scale-105">
                Afegir Professionals
            </a>

            <!-- Editar -->
            <a href="{{ route('projectes_comissions.edit', $projecte->id) }}" 
               class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 
                      text-white font-medium rounded-2xl shadow-lg transition-all transform hover:-translate-y-0.5 hover:scale-105">
                Editar Projecte
            </a>

        </div>

    </div>
</div>
@endsection
