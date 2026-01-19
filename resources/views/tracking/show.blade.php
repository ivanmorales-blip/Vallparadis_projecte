@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-b from-gray-100 via-gray-50 to-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl p-10 border border-gray-200/50 relative">

        <!-- Header: Título y tema -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-orange-500 tracking-tight">
                Seguiment
            </h1>
            <p class="text-gray-500 mt-2 text-lg font-medium">
                {{ $tracking->tema ?? 'Sense títol' }}
            </p>
        </div>

        <!-- Información general -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 text-gray-700">

            <!-- Columna izquierda -->
            <div class="space-y-4 p-5 bg-gray-50 rounded-xl shadow-inner border border-gray-200 hover:shadow-md transition">
                <div>
                    <p class="font-semibold text-gray-900">Tipus</p>
                    <p class="text-gray-700">{{ $tracking->tipus ?? '—' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-900">Data</p>
                    <p class="text-gray-700">{{ \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-900">Tema</p>
                    <p class="text-gray-700">{{ $tracking->tema ?? '—' }}</p>
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="space-y-4 p-5 bg-gray-50 rounded-xl shadow-inner border border-gray-200 hover:shadow-md transition">
                <div>
                    <p class="font-semibold text-gray-900">Professional</p>
                    <p class="text-gray-700">{{ $tracking->profesional->nom ?? '—' }} {{ $tracking->profesional->cognom ?? '' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-900">Avaluador</p>
                    <p class="text-gray-700">{{ $tracking->registrador->nom ?? '—' }} {{ $tracking->registrador->cognom ?? '' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-900">Estat</p>
                    <span class="px-4 py-1 rounded-full font-semibold text-sm shadow
                        {{ $tracking->estat ? 'bg-teal-100 text-teal-400 animate-pulse' : 'bg-red-100 text-red-800' }}">
                        {{ $tracking->estat ? 'Actiu' : 'Inactiu' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Comentari -->
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 mb-8 shadow-sm hover:shadow-md transition">
            <h2 class="text-xl font-bold text-gray-900 mb-3">Comentari</h2>
            <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $tracking->comentari ?? '—' }}</p>
        </div>

        <!-- Botones finales -->
        <div class="flex flex-wrap justify-start gap-4 mt-6">
            <a href="{{ route('profesional.show', $tracking->id_profesional) }}" 
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-2xl shadow-lg transition-all transform hover:-translate-y-0.5 hover:scale-105 text-center flex-1">
                Tornar
            </a>

            <a href="{{ route('tracking.profesional.edit', $tracking->id) }}" 
               class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-2xl shadow-lg transition-all transform hover:-translate-y-0.5 hover:scale-105 text-center flex-1">
                Editar
            </a>
        </div>

    </div>
</div>
@endsection
