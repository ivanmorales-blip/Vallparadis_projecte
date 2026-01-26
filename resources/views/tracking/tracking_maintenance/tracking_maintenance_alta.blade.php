@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 border border-gray-200">

        <h1 class="text-3xl font-bold text-orange-500 mb-8 text-center">
            Nou Seguiment
        </h1>

        <form action="{{ route('tracking.maintenance.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Manteniment (visual) -->
            <div class="space-y-1">
                <label class="block text-gray-700 font-semibold">
                    Manteniment
                </label>
                <input type="text"
                       value="{{ $maintenance->tipus ?? $maintenance->nom ?? '—' }}"
                       disabled
                       class="w-full px-4 py-2 border rounded-2xl bg-gray-100 text-gray-700 cursor-not-allowed">
            </div>

            <!-- Manteniment real -->
            <input type="hidden" name="id_manteniment" value="{{ $maintenance->id }}">

            <!-- Tipus -->
            <div>
                <label class="block text-gray-700 font-semibold">Tipus *</label>
                <input type="text" name="tipus" required
                       class="w-full px-4 py-2 border rounded-2xl focus:ring-2 focus:ring-orange-300 focus:outline-none">
            </div>

            <!-- Data -->
            <div>
                <label class="block text-gray-700 font-semibold">Data *</label>
                <input type="date" name="data" required
                       class="w-full px-4 py-2 border rounded-2xl focus:ring-2 focus:ring-orange-300 focus:outline-none">
            </div>

            <!-- Tema -->
            <div>
                <label class="block text-gray-700 font-semibold">Tema *</label>
                <input type="text" name="tema" required
                       class="w-full px-4 py-2 border rounded-2xl focus:ring-2 focus:ring-orange-300 focus:outline-none">
            </div>

            <!-- Comentari -->
            <div>
                <label class="block text-gray-700 font-semibold">Comentari *</label>
                <textarea name="comentari" rows="4"
                          class="w-full border border-gray-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"></textarea>
            </div>

            <!-- Avaluador -->
            <div>
                <label class="block text-gray-700 font-semibold">Avaluador *</label>
                <select name="id_profesional" required
                        class="w-full border border-gray-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un avaluador --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}">
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botones -->
            <div class="flex flex-col md:flex-row gap-4 pt-4">
                <button type="submit"
                        class="flex-1 px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-2xl shadow transition">
                    Guardar Seguiment
                </button>

                <a href="{{ route('manteniment.show', $maintenance->id) }}"
                   class="flex-1 px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-2xl shadow transition text-center">
                    Cancel·lar
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
