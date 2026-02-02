@extends('layouts.template')

@section('contingut')

<div class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-100 p-8">

    <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-gray-100 relative">

        <!-- Encabezado -->
        <div class="flex items-start justify-between mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">
                    Accidentabilitat
                    <span class="text-orange-500">
                        {{ $accident->professional->nom ?? '' }}
                    </span>
                </h1>
                <p class="text-gray-500 mt-1 text-sm">
                    Detall de l'accident registrat
                </p>
            </div>

            <!-- Badge -->
            <div>
                <span class="px-6 py-2 rounded-full bg-orange-100 text-orange-700 font-semibold text-sm shadow animate-pulse">
                    Accidentabilitat
                </span>
            </div>
        </div>

        <!-- Datos principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- Tipus d'accident -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Tipus d'accident</h3>
                <p class="text-gray-600 mt-1 capitalize">
                    {{ str_replace('_', ' ', $accident->tipus) }}
                </p>
            </div>

            <!-- Data de l'accident -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Data de l'accident</h3>
                <p class="text-gray-600 mt-1">
                    {{ \Carbon\Carbon::parse($accident->data)->format('d/m/Y') }}
                </p>
            </div>

            <!-- Professional que registra -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Professional que emplena</h3>
                <p class="text-gray-600 mt-1">
                    {{ $accident->professional->nom ?? 'N/A' }}
                </p>
            </div>

            <!-- Durada de la baixa -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Durada de la baixa</h3>
                <p class="text-gray-600 mt-1">
                    @if($accident->durada)
                        {{ $accident->durada }} 
                    @else
                        Sense baixa
                    @endif
                </p>
            </div>

            <!-- Context -->
            <div class="col-span-2 bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Context</h3>
                <p class="text-gray-600 mt-2 leading-relaxed">
                    {{ $accident->context }}
                </p>
            </div>

            <!-- Descripció -->
            <div class="col-span-2 bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Descripció de l'accident</h3>
                <p class="text-gray-600 mt-2 leading-relaxed">
                    {{ $accident->descripcio }}
                </p>
            </div>

        </div>

        <!-- Botón volver -->
        <div class="mt-12 flex justify-between items-center">
            <a href="{{ route('menu') }}"
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-2xl shadow transition">
                Tornar
            </a>
        </div>

    </div>

</div>
@endsection
