@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">Afegir Servei General</h1>

        <form action="{{ route('general_services.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Tipus -->
            <div>
                <label for="tipus" class="block text-sm font-medium text-gray-700 mb-1">Tipus *</label>
                <select id="tipus" name="tipus" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona tipus --</option>
                    <option value="CUINA">CUINA</option>
                    <option value="NETEJA/BUGADERIA">NETEJA/BUGADERIA</option>
                </select>
            </div>

            <!-- Contacte -->
            <div>
                <label for="contacte" class="block text-sm font-medium text-gray-700 mb-1">Contacte *</label>
                <input type="text" id="contacte" name="contacte" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Encarregat -->
            <div>
                <label for="encarregat" class="block text-sm font-medium text-gray-700 mb-1">Encarregat *</label>
                <input type="text" id="encarregat" name="encarregat" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Centre -->
            <div>
                <label for="id_center" class="block text-sm font-medium text-gray-700 mb-1">Centre *</label>
                <select id="id_center" name="id_center" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un centre --</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}" {{ old('id_center') == $center->id ? 'selected' : '' }}>
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
                <a href="{{ route('general_services.index') }}"
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
