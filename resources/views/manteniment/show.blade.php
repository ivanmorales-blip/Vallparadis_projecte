@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8 border border-gray-200 relative">
        
        <!-- Title with status -->
        <div class="flex justify-between items-start mb-6">

            <div class="ml-4">
                @if ($manteniment->estat)
                    <span class="bg-green-200 text-green-800 px-4 py-2 rounded-full font-semibold text-sm shadow">Actiu</span>
                @else
                    <span class="bg-red-200 text-red-800 px-4 py-2 rounded-full font-semibold text-sm shadow">Inactiu</span>
                @endif
            </div>
        </div>

        <!-- Main Data -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 mb-6">
            <div>

                <p class="font-semibold">📅 Data:</p>
                <p class="mb-3">{{ \Carbon\Carbon::parse($manteniment->data)->format('d/m/Y') }}</p>
            </div>

            <div>
                <p class="font-semibold">🏫 Centre:</p>
                <p class="mb-3">{{ $manteniment->centre->nom ?? '—' }}</p>

                <p class="font-semibold">Responsable:</p>
                <p class="mb-3">{{ $manteniment->responsable }}</p>
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        <!-- Description and file -->
        <div class="mb-8">
            @if (empty($manteniment->descripcio))
                <p class="text-gray-500 italic">No hi ha una descripció assignada a aquest manteniment.</p>
            @else
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">📝 Descripció</h2>
                <p class="text-gray-700 mb-4">{{ $manteniment->descripcio }}</p>
            @endif
        </div>

        <!-- Buttons -->
        <div class="flex flex-wrap justify-between gap-4">
            <!-- Back -->
            <a href="{{ route('manteniment.index') }}" 
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl shadow transition">
                ⬅️ Tornar al llistat
            </a>

            @if($manteniment->documentacio)
                <a href="{{ asset('storage/' . $manteniment->documentacio) }}" target="_blank" 
                   class="inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl shadow transition">
                    📎 Veure fitxer
                </a>
            @endif

            <!-- Edit -->
            <a href="{{ route('manteniment.edit', ['manteniment' => $manteniment->id]) }}" 
               class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl shadow transition">
                ✏️ Editar manteniment
            </a>
        </div>
    </div>
</div>
@endsection
