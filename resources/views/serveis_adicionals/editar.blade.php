@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen flex justify-center items-start">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">Edición Servei Complementari</h1>

    <form action="{{ route('serveis_adicional.update', $serveis_adicional) }}" method="POST">
    @csrf
    @method('PUT')

            <!-- Tipus -->
            <div>
                <label for="tipus" class="block text-sm font-medium text-gray-700 mb-1">Tipus *</label>
                <input id="tipus" name="tipus" type="text" value="{{ old('tipus', $serveis_adicional->tipus) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Contacte -->
            <div>
                <label for="contacte" class="block text-sm font-medium text-gray-700 mb-1">Contacte *</label>
                <input type="text" id="contacte" name="contacte" value="{{ old('contacte', $serveis_adicional->contacte) }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- responsable -->
            <div>
                <label for="responsable" class="block text-sm font-medium text-gray-700 mb-1">Responsable *</label>
                <input type="text" id="responsable" name="responsable" value="{{ old('responsable', $serveis_adicional->responsable) }}"required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Data inici -->
            <div>
                <label for="data_inici" class="block text-sm font-medium text-gray-700 mb-1">Data inici *</label>
                <input type="date" id="data_inici" name="data_inici" required value="{{ old('data_inici', optional($serveis_adicional->data_inici)->format('Y-m-d')) }}"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Observacions / Seguiment (opcional) -->
            <div>
                <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions / Seguiment</label>
                <textarea name="observacions" rows="3"
                class="w-full border rounded-xl">{{ old('observacions', $serveis_adicional->observacions) }}</textarea>
            </div>

            <input type="hidden" name="centre_id" value="{{ old('centre_id', $serveis_adicional->centre_id) }}">


            <!-- Botón enviar -->
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('serveis_adicional.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-xl shadow-md transition">Cancelar</a>
                <button type="submit" class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-lg transition transform hover:-translate-y-0.5 hover:scale-105">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
