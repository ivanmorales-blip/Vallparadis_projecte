@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-b from-gray-100 via-gray-50 to-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl p-10 border border-gray-200/50 relative">

        <!-- Título y estado -->
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-orange-500 tracking-tight leading-tight">
                    {{ $training->nom_curs }}
                </h1>
                <p class="text-gray-500 mt-1 text-lg">Detall de la formació</p>
            </div>
            <span class="px-5 py-2 rounded-full font-semibold text-sm shadow
                        {{ $training->estat ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $training->estat ? 'Actiu' : 'Inactiu' }}
            </span>
        </div>

        <!-- Información principal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 text-gray-700">

            <!-- Card izquierda -->
            <div class="p-5 bg-gray-50 rounded-xl shadow-inner border border-gray-200 space-y-2 text-sm">
                <p class="font-semibold text-gray-900">Data d'inici</p>
                <p class="text-gray-700">{{ \Carbon\Carbon::parse($training->data_inici)->format('d/m/Y') }}</p>

                <p class="font-semibold text-gray-900">Data de finalització</p>
                <p class="text-gray-700">{{ \Carbon\Carbon::parse($training->data_fi)->format('d/m/Y') }}</p>

                <p class="font-semibold text-gray-900">Hores totals</p>
                <p class="text-gray-700">{{ $training->hores }} hores</p>
            </div>

            <!-- Card derecha -->
            <div class="p-5 bg-gray-50 rounded-xl shadow-inner border border-gray-200 space-y-2 text-sm">
                <p class="font-semibold text-gray-900">Centre</p>
                <p class="text-gray-700">{{ $training->center->nom ?? '—' }}</p>

                <p class="font-semibold text-gray-900">Objectiu</p>
                <p class="text-gray-700">{{ $training->objectiu ?? '—' }}</p>

                <p class="font-semibold text-gray-900">Formador</p>
                <p class="text-gray-700">{{ $training->formador }}</p>
            </div>
        </div>

        <!-- Separador -->
        <div class="my-12 border-t border-gray-200"></div>

        <!-- Profesionales asignados -->
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Professionals assignats</h2>

        @if ($training->professionals->isEmpty())
            <p class="text-gray-500 italic py-6 bg-gray-50 rounded-xl text-center text-sm">
                No hi ha professionals assignats a aquesta formació.
            </p>
        @else
            <ul class="space-y-3 max-h-96 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-orange-400 scrollbar-track-gray-200">
                @foreach ($training->professionals as $prof)
                    <li class="p-4 bg-white rounded-xl border border-gray-200 shadow-md
                               hover:shadow-xl transition relative text-sm">
                        <p class="font-semibold text-gray-900">{{ $prof->nom }} {{ $prof->cognom }}</p>
                        <p class="text-gray-600 text-sm">{{ $prof->email }}</p>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Botones finales -->
        <div class="flex flex-wrap justify-between gap-4 mt-10">

            <!-- Volver -->
            <a href="{{ route('trainings.index') }}"
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-2xl shadow-lg 
                      transition-all transform hover:-translate-y-0.5 hover:scale-105">
                Tornar al llistat
            </a>

            <!-- Gestionar profesionales -->
            <a href="{{ route('trainings.afegir_professionals', $training->id) }}"
               class="px-6 py-3 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 
                      text-white font-bold rounded-2xl shadow-xl transition-all transform hover:-translate-y-1 hover:scale-105">
                Gestionar professionals
            </a>

            <!-- Editar -->
            <a href="{{ route('trainings.edit', $training->id) }}"
               class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 
                      text-white font-medium rounded-2xl shadow-lg transition-all transform hover:-translate-y-0.5 hover:scale-105">
                Editar curs
            </a>

        </div>

    </div>
</div>
@endsection
