@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">
        Llistat d'Evaluacions
    </h1>

        <!-- PROMIG GLOBAL -->
    <div class="max-w-lg mx-auto bg-orange-100 border border-orange-300 rounded-xl p-4 mb-6 text-center shadow-sm">
        <p class="text-lg font-semibold text-orange-800">
            Promig global de valoracions: 
            <span class="text-orange-600 text-xl">{{ number_format($averageSumatori, 2) }}</span>
        </p>
    </div>


    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">#</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Data</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Sumatori</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Observacions</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Arxiu</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Sumatori</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Profesional</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Profesional Avaluador</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Estat</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Accions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($evaluations as $evaluation)
                    <tr id="row-{{ $evaluation->id }}" data-id="{{ $evaluation->id }}" class="hover:bg-orange-50 transition duration-200">
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $evaluation->id }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $evaluation->data }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ number_format($evaluation->sumatori, 1) }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $evaluation->observacions }}</td>
                        <td class="px-6 py-4 text-center">
    @if($evaluation->arxiu)
        <a href="{{ route('evaluation.download', $evaluation) }}" 
           class="text-orange-500 hover:text-orange-600 underline">
            Descarregar
        </a>
    @else
        <span class="text-gray-400">—</span>
    @endif
</td>

                        <td class="px-6 py-4 text-gray-700">{{ $evaluation->profesional->nom ?? '' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $evaluation->profesionalAvaluador->nom ?? '' }}</td>

                        <td class="px-6 py-4">
                            <span class="estado px-2 py-1 rounded-full font-semibold text-sm {{ $evaluation->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ $evaluation->estat ? 'Actiu' : 'Inactiu' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 flex space-x-3" onclick="event.stopPropagation()">
                            <a href="{{ route('evaluation.edit', $evaluation) }}" class="text-orange-400 hover:text-orange-500 transition" title="Editar">
                                <svg class="h-6 w-6" aria-label="Editar">
                                    <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                                </svg>
                            </a>

                            <button class="activar-desactivar text-sm transition"
                                title="{{ $evaluation->estat ? 'Desactivar' : 'Activar' }}">
                                <svg class="h-6 w-6 {{ $evaluation->estat ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}"
                                    aria-label="{{ $evaluation->estat ? 'Desactivar' : 'Activar' }}">
                                    <use href="{{ asset('icons/sprite.svg#' . ($evaluation->estat ? 'icon-x' : 'icon-check')) }}"></use>
                                </svg>
                            </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('menu') }}" class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
            Tornar al menú
        </a>
    </div>
</div>

@endsection
