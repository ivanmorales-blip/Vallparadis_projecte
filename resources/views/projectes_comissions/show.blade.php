@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8 border border-gray-200 relative">

        <!-- Título con tipo arriba a la derecha -->
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-3xl font-bold text-orange-500">
                {{ $projecte->nom }}
            </h1>

            @php
                $tipusColors = [
                    'Projecte' => 'bg-blue-200 text-blue-800',
                    'Comissió' => 'bg-purple-200 text-purple-800'
                ];
            @endphp

            <div class="ml-4">
                <span class="{{ $tipusColors[$projecte->tipus] ?? 'bg-purple-200 text-purple-800' }} px-4 py-2 rounded-full font-semibold text-sm shadow">
                    {{ $projecte->tipus }}
                </span>
            </div>
        </div>

        <!-- Datos principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
            <div>
                <p class="font-semibold">📅 Data inici:</p>
                <p class="mb-3">{{ \Carbon\Carbon::parse($projecte->data_inici)->format('d/m/Y') }}</p>

                <p class="font-semibold">👤 Professional:</p>
                <p class="mb-3">{{ $projecte->profesional->nom ?? '—' }} {{ $projecte->profesional->cognom ?? '' }}</p>
            </div>

            <div>
                <p class="font-semibold">🏫 Centre:</p>
                <p class="mb-3">{{ $projecte->centre->nom ?? '—' }}</p>

                <p class="font-semibold">Descripció:</p>
                <p class="mb-3">{{ $projecte->descripcio ?? '—' }}</p>

                <p class="font-semibold">Observacions:</p>
                <p class="mb-3">{{ $projecte->observacions ?? '—' }}</p>
            </div>
        </div>

        <!-- Botones -->
        <div class="mt-8 flex flex-wrap justify-between gap-4">
            <a href="{{ route('menu') }}" 
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl shadow transition">
                ⬅️ Tornar
            </a>

            <a href="{{ route('projectes_comissions.edit', $projecte->id) }}" 
               class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl shadow transition">
                ✏️ Editar
            </a>
        </div>

    </div>
</div>
@endsection
