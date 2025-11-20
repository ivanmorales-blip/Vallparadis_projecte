@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 border border-gray-200">

        <h1 class="text-3xl font-bold text-orange-500 mb-8 text-center">
            Formulari Seguiments
        </h1>

        <form action="{{ route('tracking.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Tipus -->
            <div class="space-y-1">
                <label for="tipus" class="block text-gray-700 font-semibold">Tipus *</label>
                <input id="tipus" name="tipus" type="text" required
                       value="{{ old('tipus') }}"
                       class="w-full px-4 py-2 border rounded-2xl focus:ring-2 focus:ring-orange-300 focus:outline-none">
                @error('tipus')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Data -->
            <div class="space-y-1">
                <label for="data" class="block text-gray-700 font-semibold">Data *</label>
                <input id="data" name="data" type="date" required
                       value="{{ old('data') }}"
                       class="w-full px-4 py-2 border rounded-2xl focus:ring-2 focus:ring-orange-300 focus:outline-none">
                @error('data')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tema -->
            <div class="space-y-1">
                <label for="tema" class="block text-gray-700 font-semibold">Tema *</label>
                <input id="tema" name="tema" type="text" required
                       value="{{ old('tema') }}"
                       class="w-full px-4 py-2 border rounded-2xl focus:ring-2 focus:ring-orange-300 focus:outline-none">
                @error('tema')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Comentari -->
            <div class="space-y-1">
                <label for="comentari" class="block text-gray-700 font-semibold">Comentari *</label>
                <textarea id="comentari" name="comentari" rows="4" required
                          class="w-full border border-gray-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('comentari') }}</textarea>
                @error('comentari')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Professional -->
            <div class="space-y-1">
                <label for="id_profesional" class="block text-gray-700 font-semibold">Professional *</label>

                {{-- Select editable o disabled según venga de professional/show --}}
                <select id="id_profesional"
                        name="id_profesional_display"
                        {{ $disableProfessionalSelect ? 'disabled' : '' }}
                        required
                        class="w-full border border-gray-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}"
                            {{ ($selectedProfesional == $prof->id || old('id_profesional') == $prof->id) ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>

                {{-- Campo oculto para enviar valor real --}}
                @if($disableProfessionalSelect)
                    <input type="hidden" name="id_profesional" value="{{ $selectedProfesional }}">
                @else
                    <input type="hidden" name="id_profesional" value="{{ old('id_profesional') }}">
                @endif
                @error('id_profesional')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Registrador -->
            <div class="space-y-1">
                <label for="id_profesional_registrador" class="block text-gray-700 font-semibold">Registrador *</label>
                <select id="id_profesional_registrador" name="id_profesional_registrador" required
                        class="w-full border border-gray-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}" {{ old('id_profesional_registrador') == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
                @error('id_profesional_registrador')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Estat -->
            <div class="space-y-1">
                <label for="estat" class="block text-gray-700 font-semibold">Estat *</label>
                <select id="estat" name="estat" required
                        class="w-full px-4 py-2 border rounded-2xl focus:ring-2 focus:ring-orange-300 focus:outline-none">
                    <option value="">-- Selecciona un estat --</option>
                    <option value="1" {{ old('estat') == 1 ? 'selected' : '' }}>Actiu</option>
                    <option value="0" {{ old('estat') == 0 ? 'selected' : '' }}>Inactiu</option>
                </select>
                @error('estat')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex flex-col md:flex-row gap-4 mt-6">
                <button type="submit"
                        class="flex-1 px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-2xl shadow transition">
                    Enviar
                </button>
                <button type="button" onclick="window.location='{{ route('menu') }}'"
                        class="flex-1 px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-2xl shadow transition">
                    Cancelar
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
