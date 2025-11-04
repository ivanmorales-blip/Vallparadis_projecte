@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
            Afegir Projecte o Comissió
        </h1>

        <form action="{{ route('projectes_comissions.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                <input type="text" id="nom" name="nom" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Tipus -->
            <div>
                <label for="tipus" class="block text-sm font-medium text-gray-700 mb-1">Tipus *</label>
                <select id="tipus" name="tipus" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un tipus --</option>
                    <option value="Projecte">Projecte</option>
                    <option value="Comissió">Comissió</option>
                </select>
            </div>

            <!-- Data inici -->
            <div>
                <label for="data_inici" class="block text-sm font-medium text-gray-700 mb-1">Data inici *</label>
                <input type="date" id="data_inici" name="data_inici" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Professional -->
            <div>
                <label for="profesional_id" class="block text-sm font-medium text-gray-700 mb-1">Professional *</label>
                <select id="profesional_id" name="profesional_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}">{{ $prof->nom }} {{ $prof->cognom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Descripció -->
            <div>
                <label for="descripcio" class="block text-sm font-medium text-gray-700 mb-1">Descripció *</label>
                <textarea id="descripcio" name="descripcio" rows="3" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"></textarea>
            </div>

            <!-- Observacions -->
            <div>
                <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                <textarea id="observacions" name="observacions" rows="3"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"></textarea>
            </div>

            <!-- Centre -->
            <div>
                <label for="centre_id" class="block text-sm font-medium text-gray-700 mb-1">Centre *</label>
                <select id="centre_id" name="centre_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un centre --</option>
                    @foreach ($centres as $centre)
                        <option value="{{ $centre->id }}">{{ $centre->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('menu') }}"
                   class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition shadow">
                    Cancel·lar
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
