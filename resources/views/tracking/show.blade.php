@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 flex justify-center py-10 px-4">
    <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
            Seguiment: {{ $tracking->tema }}
        </h1>

        <!-- Información general -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 mb-6">
            <div>
                <p class="font-semibold">🧩 Tipus:</p>
                <p class="mb-3">{{ $tracking->tipus ?? '—' }}</p>

                <p class="font-semibold">📅 Data:</p>
                <p class="mb-3">{{ \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') }}</p>

                <p class="font-semibold">💬 Tema:</p>
                <p class="mb-3">{{ $tracking->tema ?? '—' }}</p>
            </div>

            <div>
                <p class="font-semibold">👤 Professional:</p>
                <p class="mb-3">
                    {{ $tracking->profesional->nom ?? '—' }} {{ $tracking->profesional->cognom ?? '' }}
                </p>

                <p class="font-semibold">📝 Registrador:</p>
                <p class="mb-3">
                    {{ $tracking->registrador->nom ?? '—' }} {{ $tracking->registrador->cognom ?? '' }}
                </p>

                <p class="font-semibold">📌 Estat:</p>
                <p class="mb-3">
                    <span class="{{ $tracking->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }} px-3 py-1 rounded-full font-semibold text-sm">
                        {{ $tracking->estat ? 'Actiu' : 'Inactiu' }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Comentari -->
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-6">
            <h2 class="text-xl font-bold mb-2 text-gray-800">Comentari</h2>
            <p class="text-gray-700 whitespace-pre-line">{{ $tracking->comentari ?? '—' }}</p>
        </div>

        <!-- Botones -->
        <div class="flex justify-between">
            <a href="{{ route('profesional.show', $tracking->id_profesional) }}" 
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl shadow transition">
                ⬅️ Tornar
            </a>
            <a href="{{ route('tracking.edit', $tracking->id) }}" 
               class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl shadow transition">
                ✏️ Editar
            </a>
        </div>
    </div>
</div>
@endsection
