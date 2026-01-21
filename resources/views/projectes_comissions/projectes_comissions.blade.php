@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
            Afegir Projecte/Comissió
        </h1>

        <!-- Mostrar errores -->
        @if($errors->any())
            <div class="bg-red-100 p-4 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projectes_comissions.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                <input type="text" id="nom" name="nom" required
                       value="{{ old('nom') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Tipus -->
            <div>
                <label for="tipus" class="block text-sm font-medium text-gray-700 mb-1">Tipus *</label>
                <select id="tipus" name="tipus" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un tipus --</option>
                    <option value="projecte" {{ old('tipus')=='projecte'?'selected':'' }}>Projecte</option>
                    <option value="comissio" {{ old('tipus')=='comissio'?'selected':'' }}>Comissió</option>
                </select>
            </div>

            <!-- Data inici -->
            <div>
                <label for="data_inici" class="block text-sm font-medium text-gray-700 mb-1">Data inici *</label>
                <input type="date" id="data_inici" name="data_inici" required
                       value="{{ old('data_inici') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Professional -->
            <div>
                <label for="profesional_id" class="block text-sm font-medium text-gray-700 mb-1">Professional *</label>
                <select id="profesional_id" name="profesional_id" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}" {{ old('profesional_id')==$prof->id?'selected':'' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Descripció -->
            <div>
                <label for="descripcio" class="block text-sm font-medium text-gray-700 mb-1">Descripció *</label>
                <textarea id="descripcio" name="descripcio" rows="3" required
                          class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('descripcio') }}</textarea>
            </div>

            <!-- Observacions -->
            <div>
                <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                <textarea id="observacions" name="observacions" rows="3"
                          class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('observacions') }}</textarea>
            </div>

            <!-- Centre -->
            <div>
                <input type="hidden" id="centre_id" name="centre_id" value="{{ session('id_center') }}">
            </div>
                
            <div>
                    <label for="estat" class="block text-gray-700 font-semibold mb-2">Estat *</label>
                    <select id="estat" name="estat" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        <option value="">-- Selecciona un estat --</option>
                        <option value="1">Actiu</option>
                        <option value="0">Inactiu</option>
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
