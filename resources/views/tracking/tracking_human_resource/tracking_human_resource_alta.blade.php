@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 border border-gray-200">

        <h1 class="text-3xl font-bold text-orange-500 mb-8 text-center">
            Nou Seguiment
        </h1>

        <form action="{{ route('tracking.human_resource.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Tema Pendent visual -->
            <div>
                <label class="block text-gray-700 font-semibold">Tema Pendent</label>
                <input type="text" value="{{ $humanResource->tema_pendent ?? '' }}" disabled
                       class="w-full px-4 py-2 border rounded-2xl bg-gray-100 cursor-not-allowed">
            </div>

            <!-- Tema Pendent real (hidden) -->
            <input type="hidden" name="id_human_resource" value="{{ $humanResource->id ?? '' }}">

            <!-- Tipus -->
            <div>
                <label class="block text-gray-700 font-semibold">Tipus *</label>
                <input type="text" name="tipus" required
                       class="w-full px-4 py-2 border rounded-2xl focus:ring-2 focus:ring-orange-300">
            </div>

            <!-- Data -->
            <div>
                <label class="block text-gray-700 font-semibold">Data *</label>
                <input type="date" name="data" required
                       class="w-full px-4 py-2 border rounded-2xl focus:ring-2 focus:ring-orange-300">
            </div>

            <!-- Tema -->
            <div>
                <label class="block text-gray-700 font-semibold">Tema *</label>
                <input type="text" name="tema" required
                       class="w-full px-4 py-2 border rounded-2xl focus:ring-2 focus:ring-orange-300">
            </div>

            <!-- Comentari -->
            <div>
                <label class="block text-gray-700 font-semibold">Comentari *</label>
                <textarea name="comentari" rows="4" required
                          class="w-full border rounded-2xl px-4 py-2 focus:ring-2 focus:ring-orange-300"></textarea>
            </div>

            <!-- Avaluador -->
            <div>
                <label class="block text-gray-700 font-semibold">Avaluador *</label>
                <select name="id_profesional" required
                        class="w-full border rounded-2xl px-4 py-2 focus:ring-2 focus:ring-orange-300">
                    <option value="">-- Selecciona --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}">
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botones -->
            <div class="flex gap-4 pt-4">
                <button type="submit"
                        class="flex-1 px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-2xl shadow">
                    Guardar Seguiment
                </button>

                <a href="{{ $humanResource->id ? route('human_resources.show', $humanResource->id) : route('human_resources.index') }}"
                   class="flex-1 px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-2xl shadow text-center">
                    Cancel·lar
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
