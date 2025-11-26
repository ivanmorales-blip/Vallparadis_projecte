@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-400 text-center">Listado de Mantenimiento</h1>

<div class="overflow-x-auto">
    <table class="min-w-full divide-y shadow-lg rounded-xl bg-white border border-gray-200 divide-gray-200">
        <thead class="bg-orange-50">
            <tr>
                <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">#</th>
                <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Data Obertura</th>
                <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Descripció</th>
                <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Document Adjunt</th>
                <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Responsable</th>
                <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Estat</th>
                <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Accions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @foreach ($maintenance as $index => $maint)
                <tr class="hover:bg-orange-50 transition duration-200">

                    <!-- Each cell navigates except the action column -->
                    <td class="px-6 py-4 text-gray-500 font-medium cursor-pointer"
                        onclick="window.location='{{ route('manteniment.show', $maint->id) }}'">
                        {{ $index + 1 }}
                    </td>

                    <td class="px-6 py-4 text-gray-800 font-semibold cursor-pointer"
                        onclick="window.location='{{ route('manteniment.show', $maint->id) }}'">
                        {{ \Carbon\Carbon::parse($maint->data_obertura)->format('d/m/Y') }}
                    </td>

                    <td class="px-6 py-4 text-gray-700 cursor-pointer"
                        onclick="window.location='{{ route('manteniment.show', $maint->id) }}'">
                        {{ $maint->descripcio }}
                    </td>

                    <td class="px-6 py-4 text-gray-700 cursor-pointer"
                        onclick="window.location='{{ route('manteniment.show', $maint->id) }}'">
                        {{ !empty($maint->documentacio) ? 'Yes' : '' }}
                    </td>

                    <td class="px-6 py-4 text-gray-700 cursor-pointer"
                        onclick="window.location='{{ route('manteniment.show', $maint->id) }}'">
                        {{ $maint->responsable }}
                    </td>

                    <td class="px-6 py-4 cursor-pointer"
                        onclick="window.location='{{ route('manteniment.show', $maint->id) }}'">
                        <span class="estado px-2 py-1 rounded-full text-sm 
                            {{ $maint->estat ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $maint->estat ? 'Actiu' : 'Inactiu' }}
                        </span>
                    </td>

                    <!-- The action column is now SAFE — no onclick redirect -->
                    <td class="px-6 py-4 flex space-x-3">

                        <!-- Edit -->
                        <a href="{{ route('manteniment.edit', $maint) }}" 
                           class="text-orange-400 hover:text-orange-500 transition" 
                           title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                                <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>

                        <!-- Toggle Active -->
                        <form action="{{ route('manteniment.active', $maint) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="activar-desactivar text-sm transition"
                                title="{{ $maint->estat ? 'Desactivar' : 'Activar' }}">
                                <svg class="h-6 w-6 
                                    {{ $maint->estat ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}"
                                    aria-label="{{ $maint->estat ? 'Desactivar' : 'Activar' }}">
                                    <use href="{{ asset('icons/sprite.svg#' . ($maint->estat ? 'icon-x' : 'icon-check')) }}"></use>
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
