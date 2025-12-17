@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 py-16 px-6">

    <div class="max-w-5xl mx-auto relative">

        <!-- Glow decoratiu -->
        <div class="absolute -top-10 -left-10 w-72 h-72 bg-orange-300/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-indigo-300/20 rounded-full blur-3xl"></div>

        <!-- Targeta principal -->
        <div class="relative bg-white/80 backdrop-blur-xl border border-white/40 shadow-2xl 
                    rounded-3xl px-10 py-12 ring-1 ring-gray-200/50">

            <!-- Títol -->
            <div class="flex justify-between items-start mb-12">

                <div>
                    <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight mb-3">
                        Servei General
                    </h1>

                    <p class="text-gray-500 text-lg">
                        Informació detallada del servei
                    </p>
                </div>

                <!-- Tag animat -->
                <span class="px-5 py-2.5 bg-gradient-to-r from-orange-400 to-orange-500 text-white 
                             font-semibold rounded-full shadow-lg text-sm animate-pulse">
                    {{ $general_service->tipus }}
                </span>
            </div>

            <!-- GRID de dades -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                <!-- Card 1 -->
                <div class="p-6 rounded-2xl bg-gray-50/60 border border-gray-200 shadow-inner 
                            hover:shadow-xl transition-all duration-300">
                    <p class="text-gray-900 font-semibold mb-1 text-lg">Contacte</p>
                    <p class="text-gray-700 text-base">{{ $general_service->contacte }}</p>

                    <div class="h-px bg-gray-200 my-5"></div>

                    <p class="text-gray-900 font-semibold mb-1 text-lg">Encarregat</p>
                    <p class="text-gray-700">{{ $general_service->encarregat }}</p>
                </div>

                <!-- Card 2 -->
                <div class="p-6 rounded-2xl bg-gray-50/60 border border-gray-200 shadow-inner 
                            hover:shadow-xl transition-all duration-300">

                    <p class="text-gray-900 font-semibold mb-1 text-lg">Centre</p>
                    <p class="text-gray-700 mb-5">
                        {{ $general_service->center->nom ?? '—' }}
                    </p>

                    <div class="h-px bg-gray-200 my-5"></div>

                    <p class="text-gray-900 font-semibold mb-1 text-lg">Observacions</p>
                    <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">
                        {{ $general_service->observacions ?? '—' }}
                    </p>
                </div>

            </div>

            <!-- Botons -->
            <div class="flex flex-wrap justify-between gap-5 mt-12">

                <!-- Back -->
                <a href="{{ route('general_services.index') }}" 
                   class="px-7 py-3.5 text-gray-700 bg-white border border-gray-300 rounded-2xl 
                          shadow hover:shadow-xl hover:bg-gray-100 transition-all 
                          hover:-translate-y-0.5 hover:scale-[1.03] font-medium">
                    ← Tornar al llistat
                </a>

                <!-- Edit -->
                <a href="{{ route('general_services.edit', $general_service->id) }}" 
                   class="px-8 py-3.5 bg-gradient-to-r from-indigo-500 to-purple-600 
                          text-white font-semibold rounded-2xl shadow-lg 
                          hover:shadow-2xl transition-all hover:-translate-y-1 
                          hover:scale-105">
                    Editar Servei ✏️
                </a>

            </div>

        </div>
    </div>
</div>
@endsection
