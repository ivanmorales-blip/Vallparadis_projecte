@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8 border border-gray-200 relative">
        
        <!-- Título con estado arriba a la derecha -->
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-3xl font-bold text-orange-500">
                {{ $training->nom_curs }}
            </h1>

            <div class="ml-4">
                @if ($training->estat)
                    <span class="bg-green-200 text-green-800 px-4 py-2 rounded-full font-semibold text-sm shadow">Actiu</span>
                @else
                    <span class="bg-red-200 text-red-800 px-4 py-2 rounded-full font-semibold text-sm shadow">Inactiu</span>
                @endif
            </div>
        </div>

        <!-- Datos principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
            <div>
                <p class="font-semibold">📅 Data inici:</p>
                <p class="mb-3">{{ \Carbon\Carbon::parse($training->data_inici)->format('d/m/Y') }}</p>

                <p class="font-semibold">📅 Data fi:</p>
                <p class="mb-3">{{ \Carbon\Carbon::parse($training->data_fi)->format('d/m/Y') }}</p>

                <p class="font-semibold">⏱️ Hores totals:</p>
                <p class="mb-3">{{ $training->hores }} hores</p>
            </div>

            <div>
                <p class="font-semibold">🏫 Centre:</p>
                <p class="mb-3">{{ $training->center->nom ?? '—' }}</p>

                <p class="font-semibold">🎯 Objectiu:</p>
                <p class="mb-3">{{ $training->objectiu ?? '—' }}</p>

                <p class="font-semibold">👤 Formador:</p>
                <p class="mb-3">{{ $training->formador }}</p>
            </div>
        </div>

        <!-- Línea divisoria -->
        <hr class="my-6 border-gray-300">

        <!-- Profesionales asignados -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">👥 Professionals assignats</h2>

            @if ($training->professionals->isEmpty())
                <p class="text-gray-500 italic">Encara no hi ha professionals assignats a aquest curs.</p>
            @else
                <ul class="space-y-2">
                    @foreach ($training->professionals as $prof)
                        <li class="flex justify-between items-center p-3 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-50 transition">
                            <span class="font-medium text-gray-800">{{ $prof->nom }} {{ $prof->cognom }}</span>
                            <span class="text-sm text-gray-500">{{ $prof->email }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Botones -->
        <div class="mt-8 flex flex-wrap justify-between gap-4">
            <!-- Volver -->
            <a href="{{ route('trainings.index') }}" 
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl shadow transition">
                ⬅️ Tornar al llistat
            </a>

            <!-- Añadir profesionales -->
            <a href="{{ route('trainings.addProfessionals', $training->id) }}" 
               class="px-5 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow transition">
                ➕ Gestionar professionals
            </a>

            <!-- Editar curso -->
            <a href="{{ route('trainings.edit', $training->id) }}" 
               class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl shadow transition">
                ✏️ Editar curs
            </a>
        </div>
    </div>
</div>
@endsection
