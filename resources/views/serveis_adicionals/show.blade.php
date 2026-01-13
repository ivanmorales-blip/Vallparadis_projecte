@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-b from-gray-100 via-gray-50 to-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-6 border border-gray-200/50">

        <!-- Título y tipo de servicio -->
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-3xl font-bold text-orange-500 tracking-tight">
                {{ $aditional_services->tipus }}
            </h1>
            <span class="bg-gray-200 text-gray-700 px-4 py-1 rounded-full font-semibold text-sm shadow-sm">
                Servei Adicional
            </span>
        </div>

        <!-- Datos principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 mb-6">
            <!-- Card izquierda -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-inner border border-gray-200 text-sm">
                <p class="font-semibold text-gray-900">Contacte</p>
                <p class="mb-2 text-gray-700">{{ $aditional_services->contacte }}</p>

                <p class="font-semibold text-gray-900">Responsable</p>
                <p class="mb-2 text-gray-700">{{ $aditional_services->responsable }}</p>

                <p class="font-semibold text-gray-900">Data</p>
                <p class="text-gray-700">{{ $aditional_services->data_inici}}</p>
            </div>

            <!-- Card derecha -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-inner border border-gray-200 text-sm">
                <p class="font-semibold text-gray-900">Observacions</p>
                <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $aditional_services->observacions ?? '—' }}</p>
            </div>
        </div>

        <!-- Botones finales -->
        <div class="flex flex-wrap justify-start gap-3 mt-4 text-sm">
            <a href="{{ route('serveis_adicionals.index') }}" 
               class="px-5 py-2 bg-gray-200 text-gray-800 rounded-xl shadow hover:bg-gray-300 transition font-medium">
                ← Tornar al llistat
            </a>
            
        </div>

    </div>
</div>
@endsection
