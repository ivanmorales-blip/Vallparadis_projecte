@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-b from-gray-100 via-gray-50 to-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-6 border border-gray-200/50">

        <!-- Encabezado: título y tipo de servicio -->
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-3xl font-bold text-orange-500 tracking-tight">
                {{ $general_service->tipus }}
            </h1>
            <span class="bg-gray-200 text-gray-700 px-4 py-1 rounded-full font-semibold text-sm shadow-sm">
                Servei General
            </span>
        </div>

        <!-- Información principal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 mb-6">
            <!-- Card izquierda -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-inner border border-gray-200 text-sm space-y-2">
                <p class="font-semibold text-gray-900">Contacte</p>
                <p class="text-gray-700">{{ $general_service->contacte }}</p>

                <p class="font-semibold text-gray-900">Encarregat</p>
                <p class="text-gray-700">{{ $general_service->encarregat }}</p>

                <p class="font-semibold text-gray-900">Horari</p>
                <p class="text-gray-700">{{ $general_service->horari ?? '—' }}</p>
            </div>

            <!-- Card derecha -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-inner border border-gray-200 text-sm space-y-2">
                <p class="font-semibold text-gray-900">Centre</p>
                <p class="text-gray-700">{{ $general_service->center->nom ?? '—' }}</p>

                <p class="font-semibold text-gray-900">Observacions</p>
                <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $general_service->observacions ?? '—' }}</p>
            </div>
        </div>

        <!-- Botón central para añadir seguimiento -->
        <div class="flex justify-center mb-6">
            <a href="{{ route('tracking.general_service.create', $general_service->id) }}"
               class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow transition font-medium text-sm">
                Afegir Seguiment
            </a>
        </div>

        <!-- Listado de seguimientos -->
        <div>
            <h2 class="text-xl font-bold text-gray-900 mb-3 border-b border-gray-300 pb-1">Seguiments</h2>

            @if($general_service->trackings->isEmpty())
                <p class="text-gray-500 italic text-center py-6 bg-gray-50 rounded-xl shadow-inner text-sm">
                    No hi ha seguiments registrats.
                </p>
            @else
                <div class="space-y-3 max-h-[450px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-orange-400 scrollbar-track-gray-200">
                    @foreach($general_service->trackings as $tracking)
                        <div class="block p-4 bg-white rounded-xl border border-gray-200 shadow-sm relative text-sm">

                            <!-- Header tarjeta -->
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="font-semibold text-gray-800">{{ $tracking->tema }}</h3>
                                <span class="text-gray-500 text-xs">{{ \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') }}</span>
                            </div>

                            <!-- Contenido tarjeta -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-700 text-sm">
                                <p><strong>Tipus:</strong> {{ $tracking->tipus }}</p>
                                <p><strong>Professional:</strong> {{ $tracking->profesional->nom ?? '—' }} {{ $tracking->profesional->cognom ?? '' }}</p>
                                <p class="md:col-span-2"><strong>Comentari:</strong> {{ $tracking->comentari ?? '—' }}</p>
                            </div>

                            <!-- Badge de estat -->
                            <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-xs font-semibold
                                  {{ $tracking->estat ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $tracking->estat ? 'Actiu' : 'Inactiu' }}
                            </span>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Botones finales -->
        <div class="flex flex-wrap justify-start gap-3 mt-6 text-sm">
            <a href="{{ route('general_services.index') }}" 
               class="px-5 py-2 bg-gray-200 text-gray-800 rounded-xl shadow hover:bg-gray-300 transition font-medium">
                ← Tornar al llistat
            </a>
            <a href="{{ route('general_services.edit', $general_service->id) }}" 
               class="px-5 py-2 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition font-medium">
                Editar Servei
            </a>
        </div>

    </div>
</div>
@endsection
