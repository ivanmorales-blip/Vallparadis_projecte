@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen flex justify-center items-start">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">Edición Centro</h1>

        <form action="{{ route('centers.update', $center) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Tipus -->
            <div>
                <label for="tipus" class="block text-gray-700 font-semibold mb-2">Tipus *</label>
                <input id="tipus" name="tipus" type="text" value="{{ $document->tipus }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Data -->
            <div>
                <label for="data_inici" class="block text-sm font-medium text-gray-700 mb-1">Data inici *</label>
                <input type="date" id="data_inici" name="data_inici" value="{{ $document->data }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Descripció -->
            <div class="space-y-1">
                <label for="descripcio" class="block text-gray-700 font-semibold">Descripció *</label>
                <textarea id="descripcio" name="descripcio" rows="4" value="{{ $document->descripcio }}" required
                    class="w-full border border-gray-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('descripcio') }}</textarea>
            </div>

            <!-- Profesional -->
            <div>
                <label for="formador" class="block text-sm font-medium text-gray-700 mb-1">Formador *</label>
                <select id="formador" name="formador" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($profesional as $prof)
                        <option value="{{ $prof->id }}">{{ $prof->nom }} {{ $prof->cognom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Document -->
            <div>
                <label for="document" class="block text-sm font-medium text-gray-700 mb-1">Document adjunt</label>
                <input type="file" id="document" name="document" value="{{ $document->document }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Centre -->
            <div>
                <label for="centre_id" class="block text-sm font-medium text-gray-700 mb-1">Centre</label>
                <select id="centre_id" name="centre_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un centre --</option>
                    @foreach($center as $center)
                        <option value="{{ $center->id }}" {{ old('centre_id') == $center->id ? 'selected' : '' }}>
                            {{ $center->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botón enviar -->
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('centers.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-xl shadow-md transition">Cancelar</a>
                <button type="submit" class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-lg transition transform hover:-translate-y-0.5 hover:scale-105">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
