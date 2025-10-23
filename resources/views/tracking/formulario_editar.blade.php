@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Editar Seguiment</h1>

    <form action="{{ route('tracking.update') }}" method="POST" class="bg-white rounded-xl shadow-lg p-8 space-y-6">
        @csrf
        @method('PUT')

        <!-- Tipus -->
        <div>
            <label for="tipus" class="block text-gray-700 font-semibold mb-1">Tipus *</label>
            <input id="tipus" name="tipus" type="text" value="{{ $tracking->tipus }}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- data -->
        <div>
            <label for="data" class="block text-gray-700 font-semibold mb-1">Data *</label>
            <input id="data" name="data" type="date" value="{{$tracking->data}}"required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Tema -->
        <div>
            <label for="tema" class="block text-gray-700 font-semibold mb-1">Tema *</label>
            <input id="tema" name="tema" type="text" value="{{$tracking->tema}}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Comentari -->
        <div>
            <label for="comentari" class="block text-gray-700 font-semibold mb-1">Comentari *</label>
            <input id="comentari" name="comentari" type="text" value="{{$tracking->comentari}}" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-300 focus:outline-none">
        </div>

        <!-- Profesional -->
        <div>
                <label for="profesional_id" class="block text-sm font-medium text-gray-700 mb-1">Professional *</label>
                <select id="profesional_id" name="profesional_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($profesional as $prof)
                        <option value="{{ $prof->id }}" {{ $projectes_comission->profesional_id == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
        </div>

        <!-- Registrador -->
        <div>
                <label for="profesional_id" class="block text-sm font-medium text-gray-700 mb-1">Registrador *</label>
                <select id="profesional_id" name="profesional_id" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($profesional as $prof)
                    <option value="{{ $prof->id }}" {{ $projectes_comission->profesional_id == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                    </option>
                    @endforeach
                </select>
        </div>

        <!-- Botons -->
        <div class="flex space-x-4 mt-4">
            <button type="submit"
                class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-md transition">
                Enviar
            </button>
            <button type="reset"
                class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-xl shadow-md transition">
                Netejar
            </button>
        </div>
    </form>
</div>
@endsection
