@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-xl mx-auto bg-white shadow-xl rounded-2xl p-8 border border-gray-200">

        <h1 class="text-2xl font-bold text-gray-700 mb-6">
            Nova Documentació
        </h1>

        <form method="POST"
              action="{{ route('documentacio.store') }}"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf

            <input type="hidden" name="id_profesional" value="{{ $id_profesional }}">

            <!-- Nom -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Nom del document
                </label>
                <input type="text" name="nom" required class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
            </div>

            <!-- Data -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Data
                </label>
                <input type="date" name="data" required class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
            </div>

            <!-- Fitxer -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Fitxer
                </label>
                <input type="file" name="document" required class="w-full text-sm text-gray-600">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between pt-4">
                <a href="{{ route('profesional.show', $id_profesional) }}"
                   class="px-4 py-2 bg-gray-200 rounded-xl hover:bg-gray-300">
                    Cancel·lar
                </a>

                <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-xl hover:bg-orange-600">
                    Guardar
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
