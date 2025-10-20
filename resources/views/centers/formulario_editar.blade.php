@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen flex justify-center items-start">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">Edición Centro</h1>

        <form action="{{ route('centers.update', $center) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label for="nom" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                <input type="text" id="nom" name="nom" value="{{ $center->nom }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Dirección -->
            <div>
                <label for="adreça" class="block text-gray-700 font-semibold mb-2">Dirección</label>
                <input type="text" id="adreça" name="adreça" value="{{ $center->adreça }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Teléfono -->
            <div>
                <label for="telefon" class="block text-gray-700 font-semibold mb-2">Teléfono</label>
                <input type="text" id="telefon" name="telefon" value="{{ $center->telefon }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Email -->
            <div>
                <label for="mail" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" id="mail" name="mail" value="{{ $center->mail }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Botón enviar -->
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('centers.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-xl shadow-md transition">Cancelar</a>
                <button type="submit" class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-lg transition transform hover:-translate-y-0.5 hover:scale-105">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
