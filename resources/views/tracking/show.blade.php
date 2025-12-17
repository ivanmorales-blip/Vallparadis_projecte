@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-100 py-10 px-4 flex justify-center">
    <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl p-10 border border-gray-200">

        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-orange-500">
                Seguiment
            </h1>
            <p class="text-gray-500 mt-2 text-lg font-medium">
                {{ $tracking->tema ?? 'Sense títol' }}
            </p>
        </div>

        {{-- Información general --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 text-gray-700">

            {{-- Columna izquierda --}}
            <div class="space-y-4">
                <div>
                    <p class="font-semibold text-gray-800">Tipus</p>
                    <p class="text-gray-600">{{ $tracking->tipus ?? '—' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-800">Data</p>
                    <p class="text-gray-600">{{ \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-800">Tema</p>
                    <p class="text-gray-600">{{ $tracking->tema ?? '—' }}</p>
                </div>
            </div>

            {{-- Columna derecha --}}
            <div class="space-y-4">
                <div>
                    <p class="font-semibold text-gray-800">Professional</p>
                    <p class="text-gray-600">
                        {{ $tracking->profesional->nom ?? '—' }} {{ $tracking->profesional->cognom ?? '' }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-800">Avaluador</p>
                    <p class="text-gray-600">
                        {{ $tracking->registrador->nom ?? '—' }} {{ $tracking->registrador->cognom ?? '' }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-800">Estat</p>
                    <span class="{{ $tracking->estat ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-4 py-1 rounded-full font-semibold text-sm">
                        {{ $tracking->estat ? 'Actiu' : 'Inactiu' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Comentari --}}
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 mb-8 shadow-sm">
            <h2 class="text-xl font-bold text-gray-800 mb-3">Comentari</h2>
            <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $tracking->comentari ?? '—' }}</p>
        </div>

        {{-- Botones --}}
        <div class="flex flex-col md:flex-row justify-between gap-4">
            <a href="{{ route('profesional.show', $tracking->id_profesional) }}" 
               class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-2xl shadow transition text-center">
                Tornar
            </a>
            <a href="{{ route('tracking.editForProfesional', $tracking->id) }}" 
               class="flex-1 px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-2xl shadow transition text-center">
                Editar
            </a>
        </div>

    </div>
</div>
@endsection
