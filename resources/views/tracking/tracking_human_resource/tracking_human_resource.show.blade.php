@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-b from-gray-100 via-gray-50 to-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-6 border">

        <div class="flex justify-between items-start mb-6">
            <h1 class="text-2xl font-bold text-orange-500">
                {{ $tracking->tema }}
            </h1>
            <span class="bg-gray-200 px-4 py-1 rounded-full text-sm font-semibold">
                Recurs Humà
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6">
            <div class="bg-gray-50 p-4 rounded-xl border space-y-2">
                <p><strong>Tipus:</strong> {{ $tracking->tipus }}</p>
                <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') }}</p>
                <p><strong>Professional:</strong> {{ $tracking->profesional->nom ?? '—' }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl border space-y-2">
                <p><strong>Avaluador:</strong> {{ $tracking->registrador->nom ?? '—' }}</p>
                <p><strong>Estat:</strong>
                    <span class="{{ $tracking->estat ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-2 py-0.5 rounded-full text-xs font-semibold">
                        {{ $tracking->estat ? 'Actiu' : 'Inactiu' }}
                    </span>
                </p>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-xl border mb-6">
            <h2 class="font-semibold mb-2">Comentari</h2>
            <p class="text-gray-700 whitespace-pre-line">{{ $tracking->comentari }}</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('human_resources.show', $tracking->id_human_resource) }}"
               class="px-5 py-2 bg-gray-200 rounded-xl shadow hover:bg-gray-300">
                ← Tornar
            </a>
            <a href="{{ route('tracking.human_resource.edit', $tracking->id) }}"
               class="px-5 py-2 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700">
                Editar
            </a>
        </div>

    </div>
</div>
@endsection
