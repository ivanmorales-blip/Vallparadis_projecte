@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-b from-gray-100 via-gray-50 to-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-6 border border-gray-200/50">

        <!-- Título -->
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-2xl font-bold text-orange-500 tracking-tight">
                {{ $tracking->tema }}
            </h1>

            <span class="bg-gray-200 text-gray-700 px-4 py-1 rounded-full font-semibold text-sm shadow-sm">
                Manteniment
            </span>
        </div>

        <!-- Información principal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 mb-6 text-sm">

            <div class="p-4 bg-gray-50 rounded-xl border shadow-inner space-y-2">
                <p><strong>Tipus:</strong> {{ $tracking->tipus }}</p>
                <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') }}</p>
                <p><strong>Professional:</strong>
                    {{ $tracking->profesional->nom ?? '—' }} {{ $tracking->profesional->cognom ?? '' }}
                </p>
            </div>

            <div class="p-4 bg-gray-50 rounded-xl border shadow-inner space-y-2">
                <p><strong>Avaluador:</strong>
                    {{ $tracking->registrador->nom ?? '—' }} {{ $tracking->registrador->cognom ?? '' }}
                </p>

                <p>
                    <strong>Estat:</strong>
                    <span class="{{ $tracking->estat ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}
                                 px-2 py-0.5 rounded-full text-xs font-semibold">
                        {{ $tracking->estat ? 'Actiu' : 'Inactiu' }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Comentari -->
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 mb-6">
            <h2 class="font-semibold text-gray-900 mb-2">Comentari</h2>
            <p class="text-gray-700 whitespace-pre-line leading-relaxed">
                {{ $tracking->comentari ?? '—' }}
            </p>
        </div>

        <!-- Botones -->
        <div class="flex flex-wrap justify-start gap-3 text-sm">
            <a href="{{ route('maintenance.show', $tracking->id_manteniment) }}"
               class="px-5 py-2 bg-gray-200 text-gray-800 rounded-xl shadow hover:bg-gray-300 transition font-medium">
                ← Tornar
            </a>

            <a href="{{ route('tracking.maintenance.edit', $tracking->id) }}"
               class="px-5 py-2 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition font-medium">
                Editar Seguiment
            </a>
        </div>

    </div>
</div>
@endsection
