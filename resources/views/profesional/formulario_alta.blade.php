@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-12 px-6">
    <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-gray-200">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8 border-b pb-4">
            <h1 class="text-3xl font-extrabold text-orange-500 tracking-tight">
                Formulari de Professional
            </h1>
            <span class="text-gray-400 text-sm">Alta de professional</span>
        </div>

        <!-- Form -->
        <form action="{{ route('profesional.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nom i Cognom -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom *</label>
                    <input id="nom" name="nom" type="text" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                </div>

                <div>
                    <label for="cognom" class="block text-gray-700 font-semibold mb-2">Cognom *</label>
                    <input id="cognom" name="cognom" type="text" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                </div>
            </div>

            <!-- Telèfon i Correu -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="telefon" class="block text-gray-700 font-semibold mb-2">Telèfon *</label>
                    <input id="telefon" name="telefon" type="tel" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Correu electrònic *</label>
                    <input id="email" name="email" type="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                </div>
            </div>

            <!-- Adreça -->
            <div>
                <label for="adreça" class="block text-gray-700 font-semibold mb-2">Adreça</label>
                <textarea id="adreça" name="adreça" rows="2"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition"></textarea>
            </div>

            <!-- Estat i Centre -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="estat" class="block text-gray-700 font-semibold mb-2">Estat *</label>
                    <select id="estat" name="estat" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        <option value="">-- Selecciona un estat --</option>
                        <option value="1">Actiu</option>
                        <option value="0">Inactiu</option>
                    </select>
                </div>

                <div>
                    <label for="id_center" class="block text-gray-700 font-semibold mb-2">Centre *</label>
                    <input type="hidden" id="id_center" name="id_center" value="{{ session('id_center') }}">
                    <input type="text"
                        class="w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-xl text-gray-700 shadow-sm cursor-not-allowed"
                        value="{{ $centre->firstWhere('id', session('id_center'))->nom ?? 'No assignat' }}" disabled>
                </div>
            </div>

            <!-- Taquilla -->
            <div>
                <label for="taquilla" class="block text-gray-700 font-semibold mb-2">Taquilla *</label>
                <input id="taquilla" name="taquilla" type="text" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
            </div>

            <!-- Talles -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="talla_samarreta" class="block text-gray-700 font-semibold mb-2">Talla Samarreta *</label>
                    <select id="talla_samarreta" name="talla_samarreta" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        <option value="">-- Selecciona --</option>
                        @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL'] as $size)
                            <option value="{{ $size }}">{{ $size }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="talla_pantalons" class="block text-gray-700 font-semibold mb-2">Talla Pantalons *</label>
                    <select id="talla_pantalons" name="talla_pantalons" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        <option value="">-- Selecciona --</option>
                        @for ($i = 36; $i <= 56; $i += 2)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label for="talla_sabates" class="block text-gray-700 font-semibold mb-2">Talla Sabates *</label>
                    <select id="talla_sabates" name="talla_sabates" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        <option value="">-- Selecciona --</option>
                        @for ($i = 35; $i <= 47; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
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
