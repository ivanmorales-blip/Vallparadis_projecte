@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-400 text-center">Listado de Centros</h1>

    <div class="overflow-x-auto shadow-lg rounded-xl bg-white border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-50">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">#</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Dirección</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Estado</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($centers as $index => $center)
                <tr class="hover:bg-orange-50 transition duration-200">
                    <td class="px-6 py-4 text-gray-500 font-medium cursor-pointer"
                        onclick="window.location='{{ route('centers.show', $center) }}'">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4 text-gray-800 font-semibold cursor-pointer"
                        onclick="window.location='{{ route('centers.show', $center) }}'">
                        {{ $center->nom }}
                    </td>
                    <td class="px-6 py-4 text-gray-700 cursor-pointer"
                        onclick="window.location='{{ route('centers.show', $center) }}'">
                        {{ $center->adreça }}
                    </td>
                    <td class="px-6 py-4 cursor-pointer"
                        onclick="window.location='{{ route('centers.show', $center) }}'">
                        <span class="estado px-2 py-1 rounded-full text-sm font-semibold {{ $center->activo ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $center->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>

                    <!-- Actions column: safe from row click -->
                    <td class="px-6 py-4 flex space-x-3" onclick="event.stopPropagation()">
                        <!-- Edit button -->
                        <a href="{{ route('centers.edit', $center) }}" 
                           class="text-orange-400 hover:text-orange-500 transition"
                           title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                                <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>

                        <!-- Toggle Active/Inactive button -->
                        <form action="{{ route('centers.active', $center) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="activar-desactivar text-sm transition"
                                    title="{{ $center->activo ? 'Desactivar' : 'Activar' }}">
                                <svg class="h-6 w-6 {{ $center->activo ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}"
                                    aria-label="{{ $center->activo ? 'Desactivar' : 'Activar' }}">
                                    <use href="{{ asset('icons/sprite.svg#' . ($center->activo ? 'icon-x' : 'icon-check')) }}"></use>
                                </svg>
                            </button>
                        </form>
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