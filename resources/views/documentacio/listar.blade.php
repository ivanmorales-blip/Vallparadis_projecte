@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-400 text-center">Listado de Centros</h1>

    <div class="overflow-x-auto shadow-lg rounded-xl bg-white border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-50">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">#</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Tipus</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Data</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Profesional</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Document Adjunt</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($document as $index => $document)
                <tr data-id="{{ $document->id }}" class="hover:bg-orange-50 transition duration-200"
                onclick="window.location='{{ route('documentacio.show', $document->id) }}'">
                    <td class="px-6 py-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">{{ $document->tipus }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $document->data }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $document->profesional }}</td>
                    <td class="px-6 py-4 text-gray-700">
                        {{ !empty($document->document) ? 'Yes' : '' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="estado px-2 py-1 rounded-full text-sm {{ $document->activo ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $document->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-3" onclick="event.stopPropagation()">
                        <a href="{{ route('documentacio.edit', $document) }}" class="text-orange-400 hover:text-orange-500 transition" title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                                <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>

                        <button class="activar-desactivar text-sm transition"
                            title="{{ $document->estat ? 'Desactivar' : 'Activar' }}">
                            <svg class="h-6 w-6 {{ $document->estat ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}"
                                aria-label="{{ $document->estat ? 'Desactivar' : 'Activar' }}">
                                <use href="{{ asset('icons/sprite.svg#' . ($document->estat ? 'icon-x' : 'icon-check')) }}"></use>
                            </svg>
                        </button>
                    </td>

                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('menu') }}" 
           class="inline-block px-6 py-3 bg-orange-400 hover:bg-orange-500 text-white rounded-xl shadow-lg transition">
           Volver a menú
        </a>
    </div>
</div>
@endsection
