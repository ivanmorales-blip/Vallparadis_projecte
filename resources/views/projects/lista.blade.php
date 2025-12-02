@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">
        Llistat de Projectes
    </h1>

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Tabla de Projectes -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Projectes</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
                    <thead class="bg-orange-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">#</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Nom</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Data Inici</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Professional</th>
                            <!--<th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Centre</th>-->
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Estat</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Accions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($projectes->where('tipus', 'projecte') as $projecte)
                            <tr id="row-{{ $projecte->id }}" class="hover:bg-orange-50 transition duration-200 cursor-pointer"
                                onclick="window.location='{{ route('projectes_comissions.show', $projecte->id) }}'">
                                <td class="px-6 py-4 text-gray-600 font-medium">{{ $projecte->id }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $projecte->nom }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ \Carbon\Carbon::parse($projecte->data_inici)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $projecte->profesional->nom ?? '' }} {{ $projecte->profesional->cognom ?? '' }}</td>
                                <!--<td class="px-6 py-4 text-gray-700">{{ $projecte->centre->nom ?? '' }}</td>-->
                                <td class="px-6 py-4">
                                    <span class="estado px-3 py-1 rounded-full font-semibold text-sm {{ $projecte->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                        {{ $projecte->estat ? 'Actiu' : 'Inactiu' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex space-x-3" onclick="event.stopPropagation()">
                                    
                                    <!-- Editar -->
                                    
                                    <a href="{{ route('projectes_comissions.edit', $projecte) }}" class="text-orange-400 hover:text-orange-500 transition" title="Editar">
                                        <svg class="h-6 w-6" aria-label="Editar">
                                            <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                                        </svg>
                                    </a>

                                    <!-- Activar / Desactivar -->
                                    <form action="{{ route('human_resources.active', $tema) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="activar-desactivar text-sm transition"
                                                title="{{ $tema->actiu ? 'Desactivar' : 'Activar' }}">
                                            <svg class="h-6 w-6 {{ $tema->actiu ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}"
                                                aria-label="{{ $tema->actiu ? 'Desactivar' : 'Activar' }}">
                                                <use href="{{ asset('icons/sprite.svg#' . ($tema->actiu ? 'icon-x' : 'icon-check')) }}"></use>
                                            </svg>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
<div class="mt-6 text-center">
        <a href="{{ route('menu') }}" class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
            Tornar al menú
        </a>
    </div>
</div>
@endsection