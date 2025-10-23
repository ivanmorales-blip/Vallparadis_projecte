@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
            Editar Evaluació
        </h1>

        <form action="{{ route('evaluation.update', $evaluation) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Data -->
            <div>
                <label for="data" class="block text-sm font-medium text-gray-700 mb-1">Data *</label>
                <input type="date" id="data" name="data" required value="{{ $evaluation->data }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Sumatori -->
            <div>
                <label for="sumatori" class="block text-sm font-medium text-gray-700 mb-1">Sumatori *</label>
                <input type="number" id="sumatori" name="sumatori" required value="{{ $evaluation->sumatori }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Observacions -->
            <div>
                <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                <textarea id="observacions" name="observacions" rows="3"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ $evaluation->observacions }}</textarea>
            </div>

            <!-- Arxiu -->
            <div>
                <label for="arxiu" class="block text-sm font-medium text-gray-700 mb-1">Arxiu</label>
                <input type="file" id="arxiu" name="arxiu"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Profesional -->
            <div>
                <label for="id_profesional" class="block text-sm font-medium text-gray-700 mb-1">Professional *</label>
                <select id="id_profesional" name="id_profesional" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}" {{ $evaluation->id_profesional == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Profesional_Avaluador -->
            <div>
                <label for="id_profesional_avaluador" class="block text-sm font-medium text-gray-700 mb-1">Profesional Avaluador *</label>
                <select id="id_profesional_avaluador" name="id_profesional_avaluador" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un profesional avaluador --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}" {{ $evaluation->id_profesional_avaluador == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
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
