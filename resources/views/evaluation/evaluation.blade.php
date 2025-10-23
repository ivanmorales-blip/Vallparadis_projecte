@extends('layouts.template')

@section('contingut')
<div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-8 mx-auto mt-10">
    <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
        Afegir Evaluació
    </h1>

    <form action="{{ route('evaluation.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        
        <!-- Data -->
        <div>
            <label for="data" class="block text-sm font-medium text-gray-700 mb-1">Data *</label>
            <input type="date" id="data" name="data" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                value="{{ old('data') }}">
        </div>

        <!-- Sumatori -->
        <div>
            <label for="sumatori" class="block text-sm font-medium text-gray-700 mb-1">Sumatori *</label>
            <input type="number" id="sumatori" name="sumatori" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                value="{{ old('sumatori') }}">
        </div>

        <!-- Observacions -->
        <div>
            <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
            <textarea id="observacions" name="observacions"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('observacions') }}</textarea>
        </div>

        <!-- Arxiu -->
        <div>
            <label for="arxiu" class="block text-sm font-medium text-gray-700 mb-1">Arxiu</label>
            <input type="file" id="arxiu" name="arxiu"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                value="{{ old('arxiu') }}">
        </div>

        <!-- Professional -->
        <div>
            <label for="profesional_id" class="block text-sm font-medium text-gray-700 mb-1">Professional *</label>
            <select id="profesional_id" name="id_profesional" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="">Selecciona un professional</option>
                @foreach($professionals as $prof)
                    <option value="{{ $prof->id }}" {{ old('profesional_id') == $prof->id ? 'selected' : '' }}>
                        {{ $prof->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Professional Avaluador -->
        <div>
            <label for="profesional_avaluador_id" class="block text-sm font-medium text-gray-700 mb-1">Professional Avaluador</label>
            <select id="profesional_avaluador_id" name="id_profesional_avaluador"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="">Selecciona un professional avaluador</option>
                @foreach($professionals as $prof)
                    <option value="{{ $prof->id }}" {{ old('profesional_avaluador_id') == $prof->id ? 'selected' : '' }}>
                        {{ $prof->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Centre -->
        <!--<div>
            <label for="center_id" class="block text-sm font-medium text-gray-700 mb-1">Centre *</label>
            <select id="center_id" name="center_id" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="">Selecciona un centre</option>
                @foreach($centres as $center)
                    <option value="{{ $center->id }}" {{ old('center_id') == $center->id ? 'selected' : '' }}>
                        {{ $center->nom }}
                    </option>
                @endforeach
            </select>
        </div><!-->

        <div class="text-center">
            <button type="submit"
                class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
