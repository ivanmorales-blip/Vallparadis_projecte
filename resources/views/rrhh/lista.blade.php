@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">
        Llistat de Temes Pendents
    </h1>

    <div class="flex justify-center">
        <div class="w-full max-w-6xl"></div>
    </div>

    <div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">#</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Data Obertura</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Professional Afectat</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Descripció</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Professional que Registra</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Derivat a</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Documents</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Estat</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Accions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach($temes_pendents as $tema)
                        <tr id="row-{{ $tema->id }}" class="hover:bg-orange-50 transition duration-200">

                            <!-- ID -->
                            <td class="px-6 py-4 text-gray-600 font-medium">{{ $tema->id }}</td>

                            <!-- Data -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ \Carbon\Carbon::parse($tema->data_obertura)->format('d/m/Y') ?? 'N/A' }}
                            </td>

                            <!-- Professional Afectat (solo aquí se hace clic para abrir SHOW) -->
                            <td class="px-6 py-4 text-orange-600 font-semibold hover:underline cursor-pointer"
                                onclick="window.location='{{ route('human_resources.show', $tema->id) }}'">
                                {{ $tema->profesional->nom ?? 'N/A' }} {{ $tema->profesional->cognom ?? '' }}
                            </td>


                            <!-- Descripción -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ $tema->descripcio ?? 'N/A' }}
                            </td>

                            <!-- Profesional que registra -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ $tema->professionalRegistra->name ?? 'N/A' }}
                            </td>

                            <!-- Derivat A -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ optional($tema->derivatA)->nom ?? 'N/A' }} {{ optional($tema->derivatA)->cognom ?? '' }}
                            </td>

                            <!-- Documentos -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ $tema->document ? 'SI' : 'NO' }}
                            </td>

                            <!-- Estat -->
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full font-semibold text-sm 
                                    {{ $tema->actiu ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ $tema->actiu ? 'Actiu' : 'Inactiu' }}
                                </span>
                            </td>


                            <!-- Acciones -->
                            <td class="px-6 py-4 flex space-x-3" onclick="event.stopPropagation()">
                            
                                <!-- Editar -->
                            <a href="{{ route('human_resources.edit', $tema->id) }}" 
                            class="text-orange-400 hover:text-orange-500 transition" 
                            title="Editar" 
                            onclick="event.stopPropagation()">
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
        <a href="{{ route('menu') }}"
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
            Tornar al menú
        </a>
    </div>    
</div>
@endsection
