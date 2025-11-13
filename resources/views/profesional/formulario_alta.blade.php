@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Formulari Professional</h1>

    <form action="{{ route('profesional.store') }}" method="POST" class="bg-white rounded-xl shadow-lg p-8 space-y-6">
        @csrf

        <!-- Nom -->
        <div>
            <label for="nom" class="block text-gray-700 font-semibold mb-1">Nom *</label>
            <input id="nom" name="nom" type="text" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Cognom -->
        <div>
            <label for="cognom" class="block text-gray-700 font-semibold mb-1">Cognom *</label>
            <input id="cognom" name="cognom" type="text" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Telèfon -->
        <div>
            <label for="telefon" class="block text-gray-700 font-semibold mb-1">Telèfon *</label>
            <input id="telefon" name="telefon" type="tel" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Correu electrònic -->
        <div>
            <label for="email" class="block text-gray-700 font-semibold mb-1">Correu electrònic *</label>
            <input id="email" name="email" type="email" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Adreça -->
        <div>
            <label for="adreça" class="block text-gray-700 font-semibold mb-1">Adreça</label>
            <textarea id="adreça" name="adreça" rows="2"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none"></textarea>
        </div>

        <!-- Estat -->
        <div>
            <label for="estat" class="block text-gray-700 font-semibold mb-1">Estat *</label>
            <select id="estat" name="estat" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
                <option value="">-- Selecciona un estat --</option>
                <option value="1">Actiu</option>
                <option value="0">Inactiu</option>
            </select>
        </div>

       <!-- Centre -->
        <div>
            <label for="id_center" class="block text-gray-700 font-semibold mb-1">Centre *</label>
            <input type="hidden" id="id_center" name="id_center" value="{{ session('id_center') }}">
            <input type="text" class="w-full px-4 py-2 border rounded-lg bg-gray-100 cursor-not-allowed" 
                value="{{ $centre->firstWhere('id', session('id_center'))->nom ?? 'No assignat' }}" disabled>
        </div>


        <!-- Taquilla -->
        <div>
            <label for="taquilla" class="block text-gray-700 font-semibold mb-1">Taquilla *</label>
            <input id="taquilla" name="taquilla" type="text" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Talla Samarreta -->
        <div>
            <label for="talla_samarreta" class="block text-gray-700 font-semibold mb-1">Talla Samarreta *</label>
            <select id="talla_samarreta" name="talla_samarreta" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
                <option value="">-- Selecciona --</option>
                @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL'] as $size)
                    <option value="{{ $size }}">{{ $size }}</option>
                @endforeach
            </select>
        </div>

        <!-- Talla Pantalons -->
        <div>
            <label for="talla_pantalons" class="block text-gray-700 font-semibold mb-1">Talla Pantalons *</label>
            <select id="talla_pantalons" name="talla_pantalons" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
                <option value="">-- Selecciona --</option>
                @for ($i = 36; $i <= 56; $i += 2)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <!-- Talla Sabates -->
        <div>
            <label for="talla_sabates" class="block text-gray-700 font-semibold mb-1">Talla Sabates *</label>
            <select id="talla_sabates" name="talla_sabates" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
                <option value="">-- Selecciona --</option>
                @for ($i = 35; $i <= 47; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <!-- Botons -->
        <div class="flex space-x-4 mt-4">
            <button type="submit"
                class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-md transition">
                Enviar
            </button>
            <button type="reset"
                class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-xl shadow-md transition">
                Netejar
            </button>
        </div>
    </form>
</div>
@endsection
