@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-12 px-6">
    <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-gray-200">

        <!-- Header -->
        <div class="flex items-start justify-between mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">
                    Tema Pendent: {{ $tema->tema_pendent ?? '—' }}
                </h1>
                <p class="text-gray-500 mt-1 text-sm">Detalls i seguiments del tema pendent</p>
            </div>
        </div>

        <!-- Datos principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700">Data d'obertura</h3>
                <p class="text-gray-600 mt-1">{{ \Carbon\Carbon::parse($tema->data_obertura)->format('d/m/Y') }}</p>
            </div>

            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700">Professional afectat</h3>
                <p class="text-gray-600 mt-1">{{ optional($tema->profesional)->nom ?? 'N/A' }} {{ optional($tema->profesional)->cognom ?? '' }}</p>
            </div>

            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700">Professional que registra</h3>
                <p class="text-gray-600 mt-1">{{ optional($tema->professionalRegistra)->name ?? 'N/A' }}</p>
            </div>

            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700">Derivat a</h3>
                <p class="text-gray-600 mt-1">{{ optional($tema->derivatA)->nom ?? 'N/A' }} {{ optional($tema->derivatA)->cognom ?? '' }}</p>
            </div>

            <div class="col-span-2 bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700">Descripció</h3>
                <p class="text-gray-600 mt-2">{{ $tema->descripcio ?? 'No hi ha descripció' }}</p>
            </div>
        </div>

        <!-- Botón para dar de alta Seguiment -->
        <div class="mb-8">
            <a href="{{ route('tracking.human_resource.create', ['humanResource' => $tema->id]) }}"
               class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-2xl shadow transition">
                Donar d'alta Seguiment
            </a>
        </div>

        <!-- Listado de Seguimientos -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Seguiments registrats</h2>

            @if($tema->trackings->isEmpty())
                <p class="text-gray-500 italic">Encara no hi ha seguiments registrats.</p>
            @else
                <ul class="space-y-4">
                    @foreach($tema->trackings as $tracking)
                        <li onclick="window.location='{{ route('tracking.human_resource.show', $tracking->id) }}'"
                            class="p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-100 cursor-pointer transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-700 font-semibold">{{ $tracking->tema }}</p>
                                    <p class="text-gray-500 text-sm mt-1">{{ $tracking->comentari }}</p>
                                    <p class="text-gray-400 text-xs mt-1">
                                        {{ \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') }} -
                                        {{ optional($tracking->profesional)->nom ?? 'N/A' }}
                                        {{ optional($tracking->profesional)->cognom ?? '' }}
                                    </p>
                                </div>
                               
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Botón volver -->
        <div class="mt-8 flex justify-end">
            <a href="{{ route('menu') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-2xl shadow transition">
                Tornar al llistat
            </a>
        </div>

    </div>
</div>
@endsection
