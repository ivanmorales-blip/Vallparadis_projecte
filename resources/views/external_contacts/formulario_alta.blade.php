@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-12 px-6">
    <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-gray-200">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8 border-b pb-4">
            <h1 class="text-3xl font-extrabold text-orange-500 tracking-tight">
                Contacte Extern
            </h1>
            <span class="text-gray-400 text-sm">Afegeix un contacte</span>
        </div>

        <!-- Form -->
        <form action="{{ route('external_contacts.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="centre_id" value="{{ $centre_id ?? 1 }}">
            
            <!-- Tipus de Servei -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tipus_servei" class="block text-gray-700 font-semibold mb-2">Tipus de contacte</label>
                   <select id="tipus_servei" name="tipus_servei" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                        <option value="">-- Selecciona --</option>
                        <option value="Assistencial">Assistencial</option>
                        <option value="Servei General">Servei General</option>
                    </select>

                </div>

                <!-- Empresa / Departament -->
                <div>
                    <label for="empresa_departament" class="block text-gray-700 font-semibold mb-2">Empresa / Departament</label>
                    <input type="text" name="empresa_departament" id="empresa_departament"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                </div>
            </div>

            <!-- Responsable y Telèfon -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="responsable" class="block text-gray-700 font-semibold mb-2">Responsable</label>
                    <input type="text" name="responsable" id="responsable"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                </div>

                <div>
                    <label for="telefon" class="block text-gray-700 font-semibold mb-2">Telèfon</label>
                    <input type="text" name="telefon" id="telefon"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition">
                </div>
            </div>

            <!-- Correu -->
            <div>
                <label for="correu" class="block text-gray-700 font-semibold mb-2">Correu Electrònic</label>
                <input type="email" name="correu" id="correu"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange- 400 transition">
            </div>

            <!-- Observacions -->
            <div>
                <label for="observacions" class="block text-gray-700 font-semibold mb-2">Observacions</label>
                <textarea id="observacions" name="observacions" rows="4"
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
                    Guardar Contacte
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
