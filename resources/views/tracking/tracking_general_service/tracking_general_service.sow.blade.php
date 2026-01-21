@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-b from-gray-100 via-gray-50 to-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-6 border border-gray-200/50">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-orange-500">
                Seguiment Servei General
            </h1>
            <p class="text-gray-500 mt-2 text-lg font-medium">
                {{ $tracking->tema ?? 'Sense títol' }}
            </p>
        </div>

        <!-- Información general -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 text-gray-700">

            <!-- Columna izquierda -->
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

            <!-- Columna derecha -->
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
                    <span class="px-4 py-1 rounded-full font-semibold text-sm
                                 {{ $tracking->estat ? 'bg-teal-100 text-teal-800 animate-pulse' : 'bg-red-100 text-red-800' }}">
                        {{ $tracking->estat ? 'Actiu' : 'Inactiu' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Comentari -->
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 mb-8 shadow-sm">
            <h2 class="text-xl font-bold text-gray-800 mb-3">Comentari</h2>
            <p class="text-gray-700 whitespace-pre-line leading-relaxed">
                {{ $tracking->comentari ?? '—' }}
            </p>
        </div>

        <!-- Botones finales -->
        <div class="flex flex-wrap justify-start gap-3 mt-6 text-sm">
            <a href="{{ route('general_services.show', $tracking->id_general_services) }}" 
               class="px-5 py-2 bg-gray-200 text-gray-800 rounded-xl shadow hover:bg-gray-300 transition font-medium">
                ← Tornar al servei
            </a>
            <a href="{{ route('tracking.general_service.edit', $tracking->id) }}" 
               class="px-5 py-2 bg-orange-500 text-white rounded-xl shadow hover:bg-orange-600 transition font-medium">
                Editar Seguiment
            </a>
        </div>

    </div>
</div>
@endsection
