@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Edició Professional</h1>

    <form action="{{ route('profesional.update', $profesional) }}" method="POST" class="bg-white rounded-xl shadow-lg p-8 space-y-6">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div>
            <label for="nom" class="block text-gray-700 font-semibold mb-1">Nom *</label>
            <input id="nom" name="nom" type="text" value="{{ $profesional->nom }}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Cognom -->
        <div>
            <label for="cognom" class="block text-gray-700 font-semibold mb-1">Cognom *</label>
            <input id="cognom" name="cognom" type="text" value="{{ $profesional->cognom }}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Telèfon -->
        <div>
            <label for="telefon" class="block text-gray-700 font-semibold mb-1">Telèfon *</label>
            <input id="telefon" name="telefon" type="tel" value="{{ $profesional->telefon }}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Correu electrònic -->
        <div>
            <label for="email" class="block text-gray-700 font-semibold mb-1">Correu electrònic *</label>
            <input id="email" name="email" type="email" value="{{ $profesional->email }}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Adreça -->
        <div>
            <label for="adreça" class="block text-gray-700 font-semibold mb-1">Adreça</label>
            <input id="adreça" name="adreça" type="text" value="{{ $profesional->adreça }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Centre -->
        <div>
            <label for="id_center" class="block text-gray-700 font-semibold mb-1">Centre *</label>
            <select id="id_center" name="id_center" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
                <option value="">-- Selecciona un centre --</option>
                @foreach ($centre as $c)
                    <option value="{{ $c->id }}" {{ $profesional->id_center == $c->id ? 'selected' : '' }}>
                        {{ $c->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Talla Samarreta -->
        <div>
            <label for="talla_samarreta" class="block text-gray-700 font-semibold mb-1">Talla Samarreta *</label>
            <select id="talla_samarreta" name="talla_samarreta" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
                <option value="">-- Selecciona --</option>
                @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL'] as $size)
                    <option value="{{ $size }}" {{ $profesional->talla_samarreta == $size ? 'selected' : '' }}>
                        {{ $size }}
                    </option>
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
                    <option value="{{ $i }}" {{ $profesional->talla_pantalons == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
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
                    <option value="{{ $i }}" {{ $profesional->talla_sabates == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <!-- Botons -->
        <div class="flex space-x-4 mt-4">
            <button type="submit"
                class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-md transition">
                Guardar
            </button>
            <a href="{{ route('profesional.index') }}"
                class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-xl shadow-md transition">
                Cancel·lar
            </a>
        </div>
    </form>
</div>
@endsection
