@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8 border border-gray-200 relative">
        
        <!-- Header: Título y tipo -->
        <div class="flex justify-between items-start mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-orange-500">
                {{ \Carbon\Carbon::parse($manteniment->data)->format('d/m/Y') }}
            </h1>

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
            <div class="space-y-4 p-5 bg-gray-50 rounded-xl border border-gray-200 shadow-inner">
                <p class="font-semibold">Data:</p>
                <p class="mb-3">{{ \Carbon\Carbon::parse($manteniment->data)->format('d/m/Y') }}</p>
            </div>

            <div class="space-y-4 p-5 bg-gray-50 rounded-xl border border-gray-200 shadow-inner">
                <p class="font-semibold">Centre:</p>
                <p class="mb-3">{{ $manteniment->centre->nom ?? '—' }}</p>

                <p class="font-semibold">Responsable:</p>
                <p class="mb-3">{{ $manteniment->responsable }}</p>
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        <!-- Description and file -->
        <div class="mb-8">
            <div class="space-y-4 p-5 bg-gray-50 rounded-xl border border-gray-200 shadow-inner">
            @if (empty($manteniment->descripcio))
                <p class="text-gray-500 italic">No hi ha una descripció assignada a aquest manteniment.</p>
            @else
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Descripció</h2>
                <p class="text-gray-700 mb-4">{{ $manteniment->descripcio }}</p>
            @endif
            </div>
        </div>

        <!-- Gestión: Crear Seguiment / Avaluació -->
        <div class="mt-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">
                Gestió
            </h2>

            <div class="bg-gray-50 p-6 rounded-xl shadow-inner flex flex-col md:flex-row md:space-x-6 space-y-2 md:space-y-0">
                <a
                    href="{{ route('tracking.maintenance.create', $manteniment->id) }}"
                    class="px-4 py-2 bg-orange-100 text-orange-700 rounded-xl font-medium shadow hover:bg-orange-200 transition"
                >
                    ➕ Donar d'alta Seguiment
                </a>
            </div>
        </div>

        <div class="gap-6 mb-8">
            
            <!-- Seguiments -->
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">Seguiments</h2>

                <ul class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
            @forelse($manteniment->trackings as $tracking)
        <li 
            onclick="window.location='{{ route('tracking.show', $tracking->id) }}'"
            class="p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-100 transition cursor-pointer"
        >
            <div class="space-y-1">
                <div class="font-semibold text-orange-600 text-lg">
                    {{ $tracking->tema ?? 'Seguiment sense títol' }}
                </div>

                <div class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') }}
                </div>

                <div class="text-sm text-gray-700">
                    <span class="font-semibold">Tipus:</span> {{ $tracking->tipus ?? '—' }}
                </div>

                <div class="text-sm text-gray-700">
                    <span class="font-semibold">Avaluador:</span>
                    {{ optional($tracking->registrador)->nom }}
                    {{ optional($tracking->registrador)->cognom }}
                </div>
            </div>
        </li>
    @empty
        <p class="text-gray-500 italic">
            Encara no hi ha seguiments registrats.
        </p>
    @endforelse
</ul>

            </div>

        </div>

        <!-- Buttons -->
        <div class="flex flex-wrap justify-between gap-4">
            <!-- Back -->
            <a href="{{ route('manteniment.index') }}" 
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-2xl shadow-lg 
                      transition-all transform hover:-translate-y-0.5 hover:scale-105">
                Tornar al llistat
            </a>

            @if($manteniment->documentacio)
                <a href="{{ asset('storage/' . $manteniment->documentacio) }}" target="_blank" 
                   class="px-6 py-3 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 
                      text-white font-bold rounded-2xl shadow-xl transition-all transform hover:-translate-y-1 hover:scale-105">
                    Veure fitxer
                </a>
            @endif

            <!-- Edit -->
            <a href="{{ route('manteniment.edit', ['manteniment' => $manteniment->id]) }}" 
               class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 
                      text-white font-medium rounded-2xl shadow-lg transition-all transform hover:-translate-y-0.5 hover:scale-105">
                Editar manteniment
            </a>
        </div>
    </div>
</div>
@endsection
