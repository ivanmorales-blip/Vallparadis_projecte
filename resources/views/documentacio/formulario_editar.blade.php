@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen flex justify-center items-start">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">Edición Documento</h1>

        <form action="{{ route('documentacio.update',['documentacio' => $document->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Tipus -->
            <div>
                <label for="tipus" class="block text-gray-700 font-semibold mb-2">Tipus *</label>
                <input id="tipus" name="tipus" type="text" value="{{ old('tipus', $document->tipus) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Data -->
            <div>
                <label for="data" class="block text-sm font-medium text-gray-700 mb-1">Data *</label>
                <input type="date" id="data" name="data" value="{{ old('data', $document->data) }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Descripció -->
            <div class="space-y-1">
                <label for="descripcio" class="block text-gray-700 font-semibold">Descripció *</label>
                <textarea id="descripcio" name="descripcio" rows="4" required
                    class="w-full border border-gray-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('descripcio', $document->descripcio) }}</textarea>
            </div>

            <!-- Profesional -->
            <div>
                <label for="professional_id" class="block text-sm font-medium text-gray-700 mb-1">Formador *</label>
                <select id="professional_id" name="professional_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($profesional as $prof)
                        <option value="{{ $prof->id }}" 
                            {{ $document->professional_id == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Document -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Document actual</label>
                @if($document->arxiu)
                    <a href="{{ asset('storage/' . $document->arxiu) }}" target="_blank" class="text-orange-600 underline">
                        Veure document
                    </a>
                @else
                    <p class="text-gray-500">No hi ha cap document pujat.</p>
                @endif

                <label for="document" class="block text-sm font-medium text-gray-700 mt-2">Substituir document</label>
                <input type="file" id="document" name="document"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Centre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Centre</label>
                <input type="text" value="{{ $center->nom }}" class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-100" readonly>
                <input type="hidden" name="centre_id" value="{{ $center->id }}">
            </div>

            <!-- Botón enviar -->
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('documentacio.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-xl shadow-md transition">Cancelar</a>
                <button type="submit" class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-lg transition transform hover:-translate-y-0.5 hover:scale-105">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
