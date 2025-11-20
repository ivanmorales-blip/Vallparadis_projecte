@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-3xl p-10 border border-gray-200">

        <!-- Header: Nombre y Estado -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
            <div>
                <h1 class="text-4xl font-extrabold text-orange-500">
                    {{ $profesional->nom }} {{ $profesional->cognom }}
                </h1>
                <p class="text-gray-500 mt-1">Perfil del professional</p>
            </div>
            <span class="mt-4 md:mt-0 px-5 py-2 rounded-full text-sm font-semibold 
                {{ $profesional->estat ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $profesional->estat ? 'Actiu' : 'Inactiu' }}
            </span>
        </div>

        <!-- Información General -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 mb-8">
            <div class="space-y-3">
                <p><span class="font-semibold">📞 Telèfon:</span> {{ $profesional->telefon ?? '—' }}</p>
                <p><span class="font-semibold">📧 Email:</span> {{ $profesional->email ?? '—' }}</p>
                <p><span class="font-semibold">Taquilla:</span> {{ $profesional->taquilla ?? '—' }}</p>
            </div>
            <div class="space-y-3">
                <p><span class="font-semibold">🏠 Adreça:</span> {{ $profesional->adreça ?? '—' }}</p>
                <p><span class="font-semibold">Centre:</span> {{ $profesional->center->nom ?? '—' }}</p>
                <p class="font-semibold">Talles:</p>
                <ul class="ml-4 text-gray-600">
                    <li>Samarreta: {{ $profesional->talla_samarreta ?? '—' }}</li>
                    <li>Pantalons: {{ $profesional->talla_pantalons ?? '—' }}</li>
                    <li>Sabates: {{ $profesional->talla_sabates ?? '—' }}</li>
                </ul>
            </div>
        </div>

        <!-- Gestión: Crear Seguiment / Evaluació -->
        <div class="mt-8 bg-gray-50 p-6 rounded-xl shadow-inner flex flex-col space-y-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-2 border-b border-gray-300 pb-2">Gestió</h2>
            <div class="flex flex-col md:flex-row md:space-x-6 space-y-2 md:space-y-0">
                <a href="{{ route('tracking.create', ['profesional' => $profesional->id]) }}"
                    class="px-4 py-2 bg-orange-100 text-orange-700 rounded-xl font-medium shadow hover:bg-orange-200 transition">
                    ➕ Donar d'alta Seguiment
                </a>
                <a href="{{ route('evaluation.create', ['from_profesional' => $profesional->id]) }}"
                   class="px-4 py-2 bg-orange-100 text-orange-700 rounded-xl font-medium shadow hover:bg-orange-200 transition">
                    ➕ Donar d'alta Avaluació
                </a>
            </div>
        </div>

        <!-- Seguiments -->
        <div class="bg-white shadow-lg rounded-xl p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">Seguiments</h2>
            @if($profesional->trackings->isEmpty())
                <p class="text-gray-500 italic">Encara no hi ha seguiments registrats.</p>
            @else
                <ul class="space-y-2">
                    @foreach($profesional->trackings as $tracking)
                        <li class="p-3 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-50 transition flex justify-between items-center">
                            <div>
                                <a href="{{ route('tracking.show', $tracking->id) }}" 
                                   class="font-medium text-orange-600 hover:underline">
                                   {{ $tracking->tema ?? 'Seguiment sense títol' }}
                                </a>
                                <span class="text-sm text-gray-500">
                                    | {{ \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') }}
                                </span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('tracking.edit', $tracking->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm">✏️ Editar</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Avaluacions -->
        <div class="bg-white shadow-lg rounded-xl p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">Avaluacions</h2>
            @if($profesional->evaluations->isEmpty())
                <p class="text-gray-500 italic">Encara no hi ha avaluacions registrades.</p>
            @else
                <ul class="space-y-2">
                    @foreach($profesional->evaluations as $evaluation)
                        <li class="p-3 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-50 transition flex justify-between items-center">
                            <div>
                                <a href="{{ route('evaluation.show', $evaluation->id) }}" 
                                   class="font-medium text-orange-600 hover:underline">
                                   Avaluació del {{ \Carbon\Carbon::parse($evaluation->data)->format('d/m/Y') }}
                                </a>
                                <span class="text-sm text-gray-500">
                                    | Avaluador: {{ $evaluation->avaluador->nom ?? '—' }}
                                </span>
                            </div>
                            <div class="flex space-x-2">
                                          <a href="{{ route('evaluation.edit', ['evaluation' => $evaluation->id, 'from_profesional' => $profesional->id]) }}" 
                                              class="text-blue-600 hover:text-blue-800 text-sm">✏️ Editar</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Botones finales -->
        <div class="flex flex-wrap justify-between gap-4">
            <a href="{{ route('profesional.index') }}" 
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl shadow transition">
                ⬅️ Tornar al llistat
            </a>
            <a href="{{ route('profesional.edit', $profesional->id) }}" 
               class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl shadow transition">
                ✏️ Editar Professional
            </a>
        </div>

    </div>
</div>
@endsection
