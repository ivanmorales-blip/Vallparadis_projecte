@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">Afegir Servei Adicional</h1>

        <form action="{{ route('serveis_adicional.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Tipus -->
            <div>
                <label for="tipus" class="block text-sm font-medium text-gray-700 mb-1">Tipus *</label>
                <input id="tipus" name="tipus" type="text" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Contacte -->
            <div>
                <label for="contacte" class="block text-sm font-medium text-gray-700 mb-1">Contacte *</label>
                <input type="text" id="contacte" name="contacte" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- responsable -->
            <div>
                <label for="responsable" class="block text-sm font-medium text-gray-700 mb-1">Responsable *</label>
                <input type="text" id="responsable" name="responsable" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Data inici -->
            <div>
                <label for="data_inici" class="block text-sm font-medium text-gray-700 mb-1">Data inici *</label>
                <input type="date" id="data_inici" name="data_inici" required
                       value="{{ old('data_inici') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Centre -->
            <div>
                <label for="centre_id" class="block text-sm font-medium text-gray-700 mb-1">Centre *</label>
                <select id="centre_id" name="centre_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un centre --</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}" {{ old('centre_id') == $center->id ? 'selected' : '' }}>
                            {{ $center->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Observacions / Seguiment (opcional) -->
            <div>
                <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions / Seguiment</label>
                <textarea id="observacions" name="observacions" rows="3"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400"></textarea>
            </div>

            <!-- Botones -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('serveis_adicional.index') }}"
                   class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition shadow">
                    Cancel·lar
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow transition">
                    Guardar Servei
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
