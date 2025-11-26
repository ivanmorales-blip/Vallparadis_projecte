@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Llistat de Cursos</h1>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
        <thead class="bg-orange-100">
            <tr>
                <th class="px-6 py-3 text-left font-semibold text-gray-700">#</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Nom</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Data Inici</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Data Fi</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Formador</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Centre</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Estat</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Accions</th>
            </tr>
        </thead>

        <tbody id="cursos-table" class="divide-y divide-gray-200">
            @foreach ($trainings as $index => $training)
            <tr class="hover:bg-orange-50 transition">

                <!-- All clickable cells except the actions column -->
                <td class="px-6 py-4 text-gray-600 font-medium cursor-pointer"
                    onclick="window.location='{{ route('trainings.show', $training->id) }}'">
                    {{ $index + 1 }}
                </td>

                <td class="px-6 py-4 font-semibold text-gray-800 cursor-pointer"
                    onclick="window.location='{{ route('trainings.show', $training->id) }}'">
                    {{ $training->nom_curs }}
                </td>

                <td class="px-6 py-4 text-gray-600 cursor-pointer"
                    onclick="window.location='{{ route('trainings.show', $training->id) }}'">
                    {{ \Carbon\Carbon::parse($training->data_inici)->format('d/m/Y') }}
                </td>

                <td class="px-6 py-4 text-gray-600 cursor-pointer"
                    onclick="window.location='{{ route('trainings.show', $training->id) }}'">
                    {{ \Carbon\Carbon::parse($training->data_fi)->format('d/m/Y') }}
                </td>

                <td class="px-6 py-4 text-gray-600 cursor-pointer"
                    onclick="window.location='{{ route('trainings.show', $training->id) }}'">
                    {{ $training->formador }}
                </td>

                <td class="px-6 py-4 text-gray-700 cursor-pointer"
                    onclick="window.location='{{ route('trainings.show', $training->id) }}'">
                    {{ $training->center->nom ?? '—' }}
                </td>

                <td class="px-6 py-4 cursor-pointer"
                    onclick="window.location='{{ route('trainings.show', $training->id) }}'">
                    <span class="estado px-2 py-1 rounded-full text-sm font-semibold 
                        {{ $training->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ $training->estat ? 'Actiu' : 'Inactiu' }}
                    </span>
                </td>

                <!-- SAFE ACTION COLUMN (no redirect) -->
                <td class="px-6 py-4 flex space-x-3">

                    <!-- Edit button -->
                    <a href="{{ route('trainings.edit', $training) }}" 
                       class="text-orange-400 hover:text-orange-500 transition"
                       title="Editar">
                        <svg class="h-6 w-6" aria-label="Editar">
                            <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                        </svg>
                    </a>

                    <!-- Toggle button -->
                    <form action="{{ route('trainings.active', $training) }}" 
                          method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="activar-desactivar text-sm transition"
                                title="{{ $training->estat ? 'Desactivar' : 'Activar' }}">
                            <svg class="h-6 w-6 
                                {{ $training->estat ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}"
                                aria-label="{{ $training->estat ? 'Desactivar' : 'Activar' }}">
                                <use href="{{ asset('icons/sprite.svg#' . ($training->estat ? 'icon-x' : 'icon-check')) }}"></use>
                            </svg>
                        </button>
                    </form>

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>


    <div class="mt-6">
        <a href="{{ route('export.cursos') }}" class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
        Exportar Cursos Excel
        </a>
        <a href="{{ route('menu') }}" 
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
           Volver a menú
        </a>
    </div>
</div>

@endsection
