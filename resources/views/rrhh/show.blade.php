@extends('layouts.template')

@section('contingut')

<div class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-100 p-8">

    <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-gray-100 relative">

        <!-- Encabezado -->
        <div class="flex items-start justify-between mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">
                    Seguiment
                    <span class="text-orange-500">
                        {{ $tema->professional->nom ?? '' }} {{ $tema->professional->cognom ?? '' }}
                    </span>
                </h1>
                <p class="text-gray-500 mt-1 text-sm">
                    Detalls del tema pendent del professional assignat
                </p>
            </div>

            <!-- Badge -->
            <div>
                <span class="px-6 py-2 rounded-full bg-purple-100 text-purple-700 font-semibold text-sm shadow animate-pulse">
                    Recursos Humans
                </span>
            </div>
        </div>

        <!-- Datos principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- Fecha -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Data d'obertura</h3>
                <p class="text-gray-600 mt-1">{{ \Carbon\Carbon::parse($tema->data_obertura)->format('d/m/Y') }}</p>
            </div>

            <!-- Professional afectat -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Professional afectat</h3>
                <p class="text-gray-600 mt-1">
                    {{ $tema->professional->nom ?? 'N/A' }} {{ $tema->professional->cognom ?? '' }}
                </p>
            </div>

            <!-- Professional que registra -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Professional que registra</h3>
                <p class="text-gray-600 mt-1">{{ $tema->professionalRegistra->name ?? 'N/A' }}</p>
            </div>

            <!-- Derivat a -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Derivat a</h3>
                <p class="text-gray-600 mt-1">
                    {{ $tema->derivatA->nom ?? 'N/A' }} {{ $tema->derivatA->cognom ?? '' }}
                </p>
            </div>

            <!-- Descripción -->
            <div class="col-span-2 bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Descripció</h3>
                <p class="text-gray-600 mt-2 leading-relaxed">{{ $tema->descripcio }}</p>
            </div>

            <!-- Documentos adjuntos -->
            <div class="col-span-2 bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Documents adjunts</h3>

                @php
                    $documents = [];

                    if ($tema->document) {
                        $decoded = json_decode($tema->document, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $documents = $decoded;
                        } else {
                            // si no es JSON, asumimos que es un solo archivo
                            $documents[] = $tema->document;
                        }
                    }
                @endphp

                @if(count($documents) > 0)
                    <ul class="mt-2 list-disc pl-5">
                        @foreach($documents as $doc)
                            <li>
                                <a href="{{ asset('storage/' . $doc) }}" target="_blank" class="text-blue-600 font-semibold hover:underline">
                                    {{ basename($doc) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600 mt-2">No hi ha documents adjunts</p>
                @endif
            </div>

        </div>

        <!-- Botones -->
        <div class="mt-12 flex justify-between items-center">
            {{-- Botón volver, pasa el centre_id para evitar error --}}
            <a href="{{ route('menu') }}"
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-2xl shadow transition">
                Tornar
            </a>

            {{-- Botón editar, pasa el modelo completo --}}
            <a href="{{ route('human_resources.edit', $tema->$id) }}"
               class="px-8 py-3 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white rounded-2xl shadow-lg font-semibold transition">
                Editar
            </a>
        </div>

    </div>

</div>
@endsection
