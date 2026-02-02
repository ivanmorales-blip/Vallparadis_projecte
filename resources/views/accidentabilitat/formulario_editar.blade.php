@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-12 px-6">
    <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-gray-200">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8 border-b pb-4">
            <h1 class="text-3xl font-extrabold text-orange-500 tracking-tight">
                Editar Accidentabilitat
            </h1>
            <span class="text-gray-400 text-sm">Formulari d'accidentabilitat</span>
        </div>

        <!-- Form -->
        <form action="{{ route('accidentabilitat.update', $accident->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Tipus d'accident -->
            <div>
                <label for="tipus" class="block text-gray-700 font-semibold mb-2">
                    Tipus d'accident 
                </label>
                <select id="tipus" name="tipus" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                    <option value="">Selecciona...</option>
                    <option value="sense_baixa" {{ $accident->tipus == 'sense_baixa' ? 'selected' : '' }}>
                        Accident sense baixa
                    </option>
                    <option value="amb_baixa" {{ $accident->tipus == 'amb_baixa' ? 'selected' : '' }}>
                        Accident amb baixa
                    </option>
                </select>
            </div>

            <!-- Data de l'accident -->
            <div>
                <label for="data" class="block text-gray-700 font-semibold mb-2">
                    Data de l'accident 
                </label>
                <input id="data" type="date" name="data" required
                       value="{{ \Carbon\Carbon::parse($accident->data)->format('Y-m-d') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
            </div>

            <!-- Professional que emplena -->
            <div>
                <label for="id_profesional" class="block text-gray-700 font-semibold mb-2">
                    Professional que emplena    
                </label>
                <select id="id_profesional" name="id_profesional" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                    <option value="">Selecciona professional...</option>
                    @foreach($professionals as $professional)
                        <option value="{{ $professional->id }}" 
                                {{ $accident->id_profesional == $professional->id ? 'selected' : '' }}>
                            {{ $professional->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Context -->
            <div>
                <label for="context" class="block text-gray-700 font-semibold mb-2">
                    Context 
                </label>
                <textarea id="context" name="context" rows="3" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">{{ $accident->context }}</textarea>
            </div>

            <!-- Descripció -->
            <div>
                <label for="descripcio" class="block text-gray-700 font-semibold mb-2">
                    Descripció de l'accident 
                </label>
                <textarea id="descripcio" name="descripcio" rows="4" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">{{ $accident->descripcio }}</textarea>
            </div>

            <!-- Durada baixa -->
            <div>
                <label for="durada" class="block text-gray-700 font-semibold mb-2">
                    Durada de la baixa
                </label>
                <input id="durada" type="text" name="durada"
                       value="{{ $accident->durada }}"
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
                    Actualitzar
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
