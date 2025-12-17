@extends('layouts.template')

@section('contingut')

<div class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-100 p-8">

    <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-gray-100 relative">

        <!-- Encabezado -->
        <div class="flex items-start justify-between mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">
                    Contacte Extern 
                    <span class="text-orange-500">{{ $contact->responsable ?? 'N/A' }}</span>
                </h1>
                <p class="text-gray-500 mt-1 text-sm">
                    Detalls del contacte extern seleccionat
                </p>
            </div>

            <!-- Badge -->
            <div>
                <span class="px-6 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold text-sm shadow animate-pulse">
                    Contacte Extern
                </span>
            </div>
        </div>

        <!-- Datos principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- Tipus de Servei -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Tipus de contacte</h3>
                <p class="text-gray-600 mt-1">{{ $contact->tipus_servei ?? 'N/A' }}</p>
            </div>

            <!-- Empresa / Departament -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Empresa / Departament</h3>
                <p class="text-gray-600 mt-1">{{ $contact->empresa_departament ?? 'N/A' }}</p>
            </div>

            <!-- Responsable -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Responsable</h3>
                <p class="text-gray-600 mt-1">{{ $contact->responsable ?? 'N/A' }}</p>
            </div>

            <!-- Telèfon -->
            <div class="bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Telèfon</h3>
                <p class="text-gray-600 mt-1">{{ $contact->telefon ?? 'N/A' }}</p>
            </div>

            <!-- Correu Electrònic -->
            <div class="col-span-2 bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Correu Electrònic</h3>
                <p class="text-gray-600 mt-1">{{ $contact->correu ?? 'N/A' }}</p>
            </div>

            <!-- Observacions -->
            <div class="col-span-2 bg-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-700">Observacions</h3>
                <p class="text-gray-600 mt-2 leading-relaxed">{{ $contact->observacions ?? 'No hi ha observacions' }}</p>
            </div>

        </div>

        <!-- Botones -->
        <div class="mt-12 flex justify-between items-center">
            <a href="{{ route('external_contacts.index') }}"
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-2xl shadow transition">
                Tornar al llistat
            </a>

            <a href="{{ route('external_contacts.edit', $contact->id) }}"
               class="px-8 py-3 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white rounded-2xl shadow-lg font-semibold transition">
                Editar
            </a>
        </div>

    </div>

</div>

@endsection
