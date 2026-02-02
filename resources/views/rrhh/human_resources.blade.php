@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-12 px-6">
    <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-gray-200">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8 border-b pb-4">
            <h1 class="text-3xl font-extrabold text-orange-500 tracking-tight">
                Tema Pendent
            </h1>
            <span class="text-gray-400 text-sm">Tema Pendent</span>
        </div>

        <!-- Form -->
        <form action="{{ route('human_resources.store', ['centre_id' => $centre_id, 'type' => $type]) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            <!-- Data Obertura -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="data_obertura" class="block text-gray-700 font-semibold mb-2">
                        Data Obertura
                    </label>
                    <input id="data_obertura"
                           name="data_obertura"
                           type="date"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                </div>
            </div>
            <!-- Tema Pendent -->
            <div>
                <label for="tema_pendent" class="block text-gray-700 font-semibold mb-2">
                    Tema Pendent
                </label>
                <input id="tema_pendent"
                       name="tema_pendent"
                       type="text"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
            </div>

            <!-- Professional Afectat -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="professional_afectat" class="block text-gray-700 font-semibold mb-2">
                        Professional Afectat
                    </label>
                    <select id="professional_afectat"
                            name="professional_afectat"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        <option value="">-- Selecciona --</option>
                        @foreach($professionals as $prof)
                            <option value="{{ $prof->id }}">{{ $prof->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Professional que Registra -->
                <div>
                    <label for="professional_registra" class="block text-gray-700 font-semibold mb-2">
                        Professional que Registra
                    </label>
                    <select id="professional_registra"
                            name="professional_registra"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        <option value="">-- Selecciona --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('professional_registra') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Derivat a -->
            <div>
                <label for="derivat_a" class="block text-gray-700 font-semibold mb-2">
                    Derivat a
                </label>
                <select name="derivat_a"
                        id="derivat_a"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                    <option value="">-- Selecciona --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}">{{ $prof->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Documentació Adjunta (SOLO 1 ARCHIVO) -->
            <div>
                <label for="documentacio_adjunta" class="block text-gray-700 font-semibold mb-2">
                    Documentació Adjunta
                </label>
                <input id="documentacio_adjunta"
                       name="documentacio_adjunta"
                       type="file"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
            </div>

            <!-- Descripció -->
            <div>
                <label for="descripcio" class="block text-gray-700 font-semibold mb-2">
                    Descripció
                </label>
                <textarea id="descripcio"
                          name="descripcio"
                          rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"></textarea>
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
