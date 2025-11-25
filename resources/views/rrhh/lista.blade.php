@extends('layouts.template')

@section('contingut')
<div class="w-full max-w-6xl bg-white shadow-lg rounded-2xl p-8 mx-auto mt-10">
    <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
        Recursos Humans 
    </h1>

    <!-- TEMES PENDENTS -->
    <h2 class="text-2xl font-semibold text-orange-400 mb-3 mt-6">Temes Pendents</h2>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-orange-100">
                <th class="border p-2">Data obertura</th>
                <th class="border p-2">Professional afectat</th>
                <th class="border p-2">Registra</th>
                <th class="border p-2">Derivat a</th>
                <th class="border p-2">Estat</th>
                <th class="border p-2">Accions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendents as $tema)
                <tr class="border hover:bg-gray-100">
                    <td class="border p-2">{{ $tema->data_obertura }}</td>
                    <td class="border p-2">{{ $tema->afectat->nom ?? '-' }}</td>
                    <td class="border p-2">{{ $tema->registra->nom ?? '-' }}</td>
                    <td class="border p-2">{{ $tema->derivat->nom ?? '-' }}</td>

                    <!-- Columna Estat -->
                    <td class="border p-2 text-center">
                        <span class="px-3 py-1 rounded-full font-semibold text-sm {{ $tema->actiu ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $tema->actiu ? 'Actiu' : 'Inactiu' }}
                        </span>
                    </td>

                    <td class="border p-2 flex gap-2 justify-center items-center">

                        <!-- Editar -->
                        <a href="{{ route('human_resources.create', [$centre_id, 'pendent']) }}#editar-{{ $tema->id }}"
                           class="text-yellow-500 hover:text-yellow-600 transition" title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                                <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>

                         <!-- Activar / Desactivar -->
                            <form action="{{ route('temes_pendents.active', $tema) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="activar-desactivar text-sm transition"
                                        title="{{ $tema->estat ? 'Desactivar' : 'Activar' }}">
                                    <svg class="h-6 w-6 {{ $tema->estat ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}"
                                            aria-label="{{ $tema->estat ? 'Desactivar' : 'Activar' }}">
                                        <use href="{{ asset('icons/sprite.svg#' . ($tema->estat ? 'icon-x' : 'icon-check')) }}"></use>
                                    </svg>
                                </button>
                            </form>

                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center p-4">No hi ha temes pendents</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- SEGUIMENTS -->
    <h2 class="text-2xl font-semibold text-orange-400 mb-3 mt-6">Seguiments</h2>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-orange-100">
                <th class="border p-2">Data</th>
                <th class="border p-2">Professional</th>
                <th class="border p-2">Descripció</th>
                <th class="border p-2">Estat</th>
                <th class="border p-2">Accions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($seguiments as $seguiment)
                <tr class="border hover:bg-gray-100">
                    <td class="border p-2">{{ $seguiment->data }}</td>
                    <td class="border p-2">{{ $seguiment->professional->nom ?? '-' }}</td>
                    <td class="border p-2">{{ $seguiment->descripcio }}</td>

                    <!-- Columna Estat -->
                    <td class="border p-2 text-center">
                        <span class="px-3 py-1 rounded-full font-semibold text-sm {{ $seguiment->actiu ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $seguiment->actiu ? 'Actiu' : 'Inactiu' }}
                        </span>
                    </td>

                    <td class="border p-2 flex gap-2 justify-center items-center">

                        <!-- Editar -->
                        <a href="{{ route('human_resources.create', [$centre_id, 'seguiment']) }}#editar-{{ $seguiment->id }}"
                           class="text-yellow-500 hover:text-yellow-600 transition" title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                                <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>

                        <!-- Activar / Desactivar -->
                            <form action="{{ route('rrhh.active', $seguiment) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="activar-desactivar text-sm transition"
                                        title="{{ $seguiment->estat ? 'Desactivar' : 'Activar' }}">
                                    <svg class="h-6 w-6 {{ $seguiment->estat ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}"
                                            aria-label="{{ $seguiment->estat ? 'Desactivar' : 'Activar' }}">
                                        <use href="{{ asset('icons/sprite.svg#' . ($seguiment->estat ? 'icon-x' : 'icon-check')) }}"></use>
                                    </svg>
                                </button>
                            </form>

                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center p-4">No hi ha seguiments</td></tr>
            @endforelse
        </tbody>
        
    </table>
     <div class="mt-6 text-center">
        <a href="{{ route('menu') }}" class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
            Tornar al menú
        </a>
    </div>
</div>
@endsection
