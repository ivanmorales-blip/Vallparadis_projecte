@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-2xl p-8 border border-gray-200">

        <!-- Header: Tema del Seguiment -->
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-3xl font-bold text-orange-500 tracking-tight">
                {{ $tracking->tema ?? 'Seguiment sense títol' }}
            </h1>

            <span class="bg-gray-200 text-gray-700 px-4 py-1 rounded-full font-semibold text-sm shadow-sm">
                Seguiment Manteniment
            </span>
        </div>

        <!-- Información principal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-gray-700 text-sm">

            <!-- Datos principales -->
            <div class="p-5 bg-gray-50 rounded-xl border border-gray-200 shadow-inner space-y-2">
                <p><strong>Tipus:</strong> {{ $tracking->tipus ?? '—' }}</p>
                <p><strong>Data:</strong> {{ $tracking->data ? \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') : '—' }}</p>
                <p><strong>Professional:</strong> 
                    {{ optional($tracking->profesional)->nom ?? '—' }} {{ optional($tracking->profesional)->cognom ?? '' }}
                </p>
            </div>

            <!-- Avaluador y Estado -->
            <div class="p-5 bg-gray-50 rounded-xl border border-gray-200 shadow-inner space-y-2">
                <p><strong>Avaluador:</strong> 
                    {{ optional($tracking->registrador)->nom ?? '—' }} {{ optional($tracking->registrador)->cognom ?? '' }}
                </p>

                <p>
                    <strong>Estat:</strong>
                    <span class="{{ $tracking->estat ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}
                                 px-2 py-0.5 rounded-full text-xs font-semibold">
                        {{ $tracking->estat ? 'Actiu' : 'Inactiu' }}
                    </span>
                </p>

                @if($tracking->humanResource)
                    <p><strong>Tema Pendent:</strong> {{ $tracking->humanResource->tema_pendent ?? '—' }}</p>
                @endif

                @if($tracking->id_manteniment && $tracking->manteniment)
                    <p><strong>Manteniment associat:</strong> {{ $tracking->manteniment->centre->nom ?? '—' }}</p>
                @endif
            </div>
        </div>

        <!-- Comentari -->
        <div class="mb-6 bg-gray-50 border border-gray-200 rounded-xl p-4">
            <h2 class="font-semibold text-gray-900 mb-2">Comentari</h2>
            <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $tracking->comentari ?? '—' }}
            </p>
        </div>

        <!-- Documentació adjunta (si aplica) -->
        @if(!empty($tracking->document))
            <div class="mb-6">
                <a href="{{ asset('storage/' . $tracking->document) }}" target="_blank"
                   class="px-5 py-2 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 
                          text-white font-bold rounded-2xl shadow-xl transition-all">
                    Veure document
                </a>
            </div>
        @endif

        <!-- Botones -->
        <div class="flex flex-wrap gap-4">
            <a href="{{ $tracking->id_manteniment ? route('manteniment.show', $tracking->id_manteniment) : route('manteniment.index') }}"
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-2xl shadow font-medium transition">
                ← Tornar
            </a>

            <a href="{{ route('tracking.maintenance.edit', $tracking->id) }}"
               class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl shadow font-medium transition">
                Editar Seguiment
            </a>
        </div>

    </div>
</div>
@endsection
