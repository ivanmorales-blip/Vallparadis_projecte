@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen flex justify-center items-start">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">Alta Centro</h1>

        <form action="{{ route('centers.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nombre -->
            <div>
                <label for="nom" class="block text-gray-700 font-semibold mb-2">Nombre *</label>
                <input id="nom" name="nom" type="text" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Dirección -->
            <div>
                <label for="adreça" class="block text-gray-700 font-semibold mb-2">Dirección</label>
                <textarea id="adreça" name="adreça" rows="2"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition"></textarea>
            </div>

            <!-- Teléfono -->
            <div>
                <label for="telefon" class="block text-gray-700 font-semibold mb-2">Teléfono *</label>
                <input id="telefon" name="telefon" type="tel" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Email -->
            <div>
                <label for="mail" class="block text-gray-700 font-semibold mb-2">Correo electrónico *</label>
                <input id="mail" name="mail" type="email" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition">
            </div>

            <!-- Botones -->
            <div class="flex justify-between items-center mt-6">
                <button type="reset"
                    class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-xl shadow-md transition">Limpiar</button>
                
                <button type="submit"
                    class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-lg transition transform hover:-translate-y-0.5 hover:scale-105">
                    Enviar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
