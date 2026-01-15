@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">Afegir Servei General</h1>

        <form action="{{ route('general_services.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Tipus -->
            <div>
                <label for="tipus" class="block text-sm font-medium text-gray-700 mb-1">Tipus *</label>
                <select id="tipus" name="tipus" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona tipus --</option>
                    <option value="CUINA" {{ old('tipus') == 'CUINA' ? 'selected' : '' }}>CUINA</option>
                    <option value="NETEJA/BUGADERIA" {{ old('tipus') == 'NETEJA/BUGADERIA' ? 'selected' : '' }}>NETEJA/BUGADERIA</option>
                </select>
                @error('tipus')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contacte -->
            <div>
                <label for="contacte" class="block text-sm font-medium text-gray-700 mb-1">Contacte *</label>
                <input type="text" id="contacte" name="contacte" required
                    value="{{ old('contacte') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                @error('contacte')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Encarregat -->
            <div>
                <label for="encarregat" class="block text-sm font-medium text-gray-700 mb-1">Encarregat *</label>
                <input type="text" id="encarregat" name="encarregat" required
                    value="{{ old('encarregat') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                @error('encarregat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Horari -->
            <div>
                <label for="horari" class="block text-sm font-medium text-gray-700 mb-1">Horari *</label>
                <input type="text" id="horari" name="horari" required
                    value="{{ old('horari') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                @error('horari')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Centre -->
            <div>
                <input type="hidden" id="id_center" name="id_center" value="{{ session('id_center') }}">
            </div>

            <!-- Observacions -->
            <div>
                <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                <textarea id="observacions" name="observacions" rows="3"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">{{ old('observacions') }}</textarea>
                @error('observacions')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
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
