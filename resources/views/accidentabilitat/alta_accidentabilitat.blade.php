@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-12 px-6">
    <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-gray-200">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8 border-b pb-4">
            <h1 class="text-3xl font-extrabold text-orange-500 tracking-tight">
                Alta Accidentabilitat
            </h1>
            <span class="text-gray-400 text-sm">Formulari d'alta</span>
        </div>

        <!-- Form -->
        <form action="{{ route('accidentabilitat.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            <!-- Tipus d'accident -->
            <div>
                <label for="tipus" class="block text-gray-700 font-semibold mb-2">
                    Tipus d'accident 
                </label>
                <select id="tipus" name="tipus" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                    <option value="">Selecciona...</option>
                    <option value="sense_baixa">Accident sense baixa</option>
                    <option value="amb_baixa">Accident amb baixa</option>
                </select>
            </div>

            <!-- Data de l'accident -->
            <div>
                <label for="data_accident" class="block text-gray-700 font-semibold mb-2">
                    Data de l'accident 
                </label>
                <input id="data_accident" type="date" name="data_accident" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
            </div>

            <!-- Centre i Professional -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Professional que emplena -->
                <div>
                    <label for="professional_id" class="block text-gray-700 font-semibold mb-2">
                        Professional que emplena 
                    </label>
                    <select id="professional_id" name="professional_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        <option value="">Selecciona professional...</option>
                        @foreach($professionals as $professional)
                            <option value="{{ $professional->id }}">{{ $professional->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Context -->
            <div>
                <label for="context" class="block text-gray-700 font-semibold mb-2">
                    Context 
                </label>
                <textarea id="context" name="context" rows="3" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"></textarea>
            </div>

            <!-- Descripció -->
            <div>
                <label for="descripcio" class="block text-gray-700 font-semibold mb-2">
                    Descripció de l'accident 
                </label>
                <textarea id="descripcio" name="descripcio" rows="4" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"></textarea>
            </div>

            <!-- Durada baixa -->
            <div>
                <label for="durada_baixa" class="block text-gray-700 font-semibold mb-2">
                    Durada de la baixa
                </label>
                <input id="durada_baixa" type="number" name="durada_baixa"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
            </div>

            <!-- Botons -->
            <div class="flex justify-end space-x-4 pt-6 border-t mt-6">
                <a href="{{ route('menu') }}"
                   class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-2xl shadow transition text-center">
                    Tornar al menú
                </a>

                <button type="submit"
                        class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-2xl shadow-md transition">
                    Enviar
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
