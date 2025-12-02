@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen flex justify-center items-start">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">Edición Documento</h1>

        <form action="{{ route('manteniment.update',$manteniment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Data -->
            <div>
                <label for="data_obertura" class="block text-sm font-medium text-gray-700 mb-1">Data *</label>
                <input type="date" id="data_obertura" name="data_obertura" value="{{ old('data_obertura', $manteniment->data_obertura) }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Descripció -->
            <div class="space-y-1">
                <label for="descripcio" class="block text-gray-700 font-semibold">Descripció *</label>
                <textarea id="descripcio" name="descripcio" rows="4" required
                    class="w-full border border-gray-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('descripcio', $manteniment->descripcio) }}</textarea>
            </div>

            <!-- Document -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Document actual</label>
                @if($manteniment->documentacio)
                    <a href="{{ asset('storage/' . $manteniment->documentacio) }}" target="_blank" class="text-orange-600 underline">
                        Veure manteniments
                    </a>
                @else
                    <p class="text-gray-500">No hi ha cap manteniments pujat.</p>
                @endif

                <label for="documentacio" class="block text-sm font-medium text-gray-700 mt-2">Substituir manteniments</label>
                <input type="file" id="documentacio" name="documentacio"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Responsable -->
            <div class="space-y-1">
                <label for="responsable" class="block text-gray-700 font-semibold">Responsable *</label>
                <textarea id="responsable" name="responsable" rows="4" required
                    class="w-full border border-gray-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('responsable', $manteniment->responsable) }}</textarea>
            </div>

            <!-- Botón enviar -->
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('manteniment.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-xl shadow-md transition">Cancelar</a>
                <button type="submit" class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-lg transition transform hover:-translate-y-0.5 hover:scale-105">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
