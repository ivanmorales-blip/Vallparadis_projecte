@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-b from-gray-100 via-gray-50 to-gray-100 p-8">
    <div class="max-w-3xl mx-auto bg-white/90 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-gray-200/50 relative">

        <!-- Título con estado arriba a la derecha -->
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-4xl font-extrabold text-orange-500 tracking-tight">
                {{ $training->nom_curs }}
            </h1>

            <div class="ml-4 flex items-center space-x-2">
                @if ($training->estat)
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold text-sm shadow-md animate-pulse">
                        ✅ Actiu
                    </span>
                @else
                    <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full font-semibold text-sm shadow-md animate-pulse">
                        ❌ Inactiu
                    </span>
                @endif
            </div>
        </div>

        <!-- Datos principales en cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 mb-6">
            <div class="p-4 bg-gray-50 rounded-xl shadow-inner border border-gray-200">
                <p class="font-semibold text-gray-800 flex items-center gap-2">📅 Data inici:</p>
                <p class="mb-3">{{ \Carbon\Carbon::parse($training->data_inici)->format('d/m/Y') }}</p>

                <p class="font-semibold text-gray-800 flex items-center gap-2">📅 Data fi:</p>
                <p class="mb-3">{{ \Carbon\Carbon::parse($training->data_fi)->format('d/m/Y') }}</p>

                <p class="font-semibold text-gray-800 flex items-center gap-2">⏱️ Hores totals:</p>
                <p class="mb-3">{{ $training->hores }} hores</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-xl shadow-inner border border-gray-200">
                <p class="font-semibold text-gray-800 flex items-center gap-2">🏫 Centre:</p>
                <p class="mb-3">{{ $training->center->nom ?? '—' }}</p>

                <p class="font-semibold text-gray-800 flex items-center gap-2">🎯 Objectiu:</p>
                <p class="mb-3">{{ $training->objectiu ?? '—' }}</p>

                <p class="font-semibold text-gray-800 flex items-center gap-2">👤 Formador:</p>
                <p class="mb-3">{{ $training->formador }}</p>
            </div>
        </div>

        <!-- Línea divisoria -->
        <hr class="my-6 border-gray-300">

        <!-- Profesionales asignados con scroll -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                👥 Professionals assignats
            </h2>

            @if ($training->professionals->isEmpty())
                <p class="text-gray-500 italic">Encara no hi ha professionals assignats a aquest curs.</p>
            @else
                <ul class="space-y-2 max-h-96 overflow-y-auto scrollbar-thin scrollbar-thumb-orange-400 scrollbar-track-gray-200">
                    @foreach ($training->professionals as $prof)
                        <li class="flex justify-between items-center p-3 bg-white rounded-2xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-200">
                            <div>
                                <span class="font-semibold text-gray-800">{{ $prof->nom }} {{ $prof->cognom }}</span>
                                <p class="text-sm text-gray-500">{{ $prof->email }}</p>
                            </div>
                            <span class="text-gray-400">👤</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Botones de acción -->
        <div class="mt-8 flex flex-wrap justify-between gap-4">
            <!-- Volver -->
            <a href="{{ route('trainings.index') }}" 
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-2xl shadow-lg transition-all duration-200">
                ⬅️ Tornar al llistat
            </a>

            <!-- Añadir profesionales -->
            <a href="{{ route('trainings.afegir_professionals', $training->id) }}" 
               class="px-6 py-3 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white rounded-2xl shadow-lg transition-all duration-200">
                ➕ Gestionar professionals
            </a>

            <!-- Editar curso -->
            <a href="{{ route('trainings.edit', $training->id) }}" 
               class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-2xl shadow-lg transition-all duration-200">
                ✏️ Editar curs
            </a>
        </div>
    </div>
</div>
@endsection
