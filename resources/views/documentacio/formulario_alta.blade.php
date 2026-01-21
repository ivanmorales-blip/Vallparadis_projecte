@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen flex justify-center items-start">
    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">Alta Documentació</h1>

        <form action="{{ route('documentacio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Tipus -->
            <div>
                <label for="tipus" class="block text-gray-700 font-semibold mb-2">Tipus *</label>
                <select id="tipus" name="tipus" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un tipus --</option>
                    <option value="Organització del Centre">Organització del Centre</option>
                    <option value="Documents del Departament">Documents del Departament</option>
                    <option value="Memòries i Seguiment anual">Memòries i Seguiment anual</option>
                    <option value="PRL">PRL</option>
                    <option value="Comitè d’Empresa">Comitè d’Empresa</option>
                    <option value="Informes professionals">Informes professionals</option>
                    <option value="Informes persones usuàries">Informes persones usuàries</option>
                    <option value="Qualitat i ISO">Qualitat i ISO</option>
                    <option value="Projectes">Projectes</option>
                    <option value="Comissions">Comissions</option>
                    <option value="Famílies">Famílies</option>
                    <option value="Comunicació i Reunions">Comunicació i Reunions</option>
                    <option value="Altres">Altres</option>
                </select>
            </div>

            <!-- Data -->
            <div>
                <label for="data" class="block text-sm font-medium text-gray-700 mb-1">Data *</label>
                <input type="date" id="data" name="data" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Descripció -->
            <div class="space-y-1">
                <label for="descripcio" class="block text-gray-700 font-semibold">Descripció *</label>
                <textarea id="descripcio" name="descripcio" rows="4" 
                    class="w-full border border-gray-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('descripcio') }}</textarea>
            </div>

            <!-- Profesional -->
            <div>
                <label for="professional_id" class="block text-sm font-medium text-gray-700 mb-1">Profesional *</label>
                <select id="professional_id" name="professional_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($profesional as $prof)
                        <option value="{{ $prof->id }}">{{ $prof->nom }} {{ $prof->cognom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Document -->
            <div>
                <label for="document" class="block text-sm font-medium text-gray-700 mb-1">Document adjunt</label>
                <input type="file" id="document" name="document"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Centre -->
            <div>
                <input type="hidden" id="centre_id" name="centre_id" value="{{ session('id_center') }}">
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
