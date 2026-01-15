@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
            Editar Curs
        </h1>

        <form action="{{ route('trainings.update', $training) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nom_curs" class="block text-sm font-medium text-gray-700 mb-1">Nom del curs *</label>
                <input type="text" id="nom_curs" name="nom_curs" value="{{ $training->nom_curs }}" required
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="data_inici" class="block text-sm font-medium text-gray-700 mb-1">Data inici *</label>
                    <input type="date" id="data_inici" name="data_inici" value="{{ $training->data_inici }}" required
                           class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                </div>
                <div>
                    <label for="data_fi" class="block text-sm font-medium text-gray-700 mb-1">Data fi *</label>
                    <input type="date" id="data_fi" name="data_fi" value="{{ $training->data_fi }}" required
                           class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                </div>
            </div>

            <div>
                <label for="hores" class="block text-sm font-medium text-gray-700 mb-1">Hores *</label>
                <input type="number" id="hores" name="hores" value="{{ $training->hores }}" required
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label for="objectiu" class="block text-sm font-medium text-gray-700 mb-1">Objectius</label>
                <textarea id="objectiu" name="objectiu" rows="3"
                          class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">{{ $training->objectiu }}</textarea>
            </div>

           <div>
                <label for="formador" class="block text-sm font-medium text-gray-700 mb-1">Professional *</label>
                <select id="formador" name="formador" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($profesional as $prof)
                        <option value="{{ $prof->id }}" {{ $training->formador == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <input type="hidden" id="center_id" name="center_id" value="{{ $training->center_id }}">
            </div>

            <div>
                <label for="estat" class="block text-sm font-medium text-gray-700 mb-1">Estat *</label>
                <select id="estat" name="estat"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-orange-400">
                    <option value="1" {{ $training->estat ? 'selected' : '' }}>Actiu</option>
                    <option value="0" {{ !$training->estat ? 'selected' : '' }}>Inactiu</option>
                </select>
            </div>

            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('trainings.index') }}"
                   class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition shadow">
                    Cancel·lar
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow transition">
                    Actualitzar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
