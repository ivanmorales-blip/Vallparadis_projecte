@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">Listado de Profesionales</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">#</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Nom</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Cognom</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Telèfon</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Email</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Adreça</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Estat</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Accions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($profesional as $index => $profesionalItem)
                <tr class="hover:bg-orange-50 transition duration-200 cursor-pointer"
                    onclick="window.location='{{ route('profesional.show', $profesionalItem->id) }}'">
                    
                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">{{ $profesionalItem->nom }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $profesionalItem->cognom }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $profesionalItem->telefon }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $profesionalItem->email }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $profesionalItem->adreça }}</td>
                    <td class="px-6 py-4">
                        <span class="estado px-2 py-1 rounded-full {{ $profesionalItem->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $profesionalItem->estat ? 'Actiu' : 'Inactiu' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-3" onclick="event.stopPropagation()">
                        <!-- Editar -->
                        <a href="{{ route('profesional.edit', $profesionalItem) }}" class="text-orange-400 hover:text-orange-500 transition" title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                                <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>

                        <!-- Activar / Desactivar -->
                        <form action="{{ route('profesional.active', $profesionalItem) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="activar-desactivar" 
                                title="{{ $profesionalItem->estat ? 'Desactivar' : 'Activar' }}">
                                <svg class="h-6 w-6 {{ $profesionalItem->estat ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}"
                                    aria-label="{{ $profesionalItem->estat ? 'Desactivar' : 'Activar' }}">
                                    <use href="{{ asset('icons/sprite.svg#' . ($profesionalItem->estat ? 'icon-x' : 'icon-check')) }}"></use>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botones de export y volver -->
    <div class="mt-6 flex flex-wrap gap-4 justify-center">
        <a href="{{ route('export.taquilla') }}" 
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
           Exportar Taquilla Excel
        </a>

        <a href="{{ route('export.uniform') }}" 
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
           Exportar Uniform Excel
        </a>

        <a href="{{ route('menu') }}" 
           class="inline-block px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl shadow transition">
           Tornar a menú
        </a>
    </div>
</div>
@endsection
