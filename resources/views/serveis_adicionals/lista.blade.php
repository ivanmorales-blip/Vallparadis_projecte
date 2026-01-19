@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Llistat de Serveis Complementaris</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">#</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Tipus</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Contacte</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Encarregat</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Accions</th>
                </tr>
            </thead>

            <tbody id="services-table" class="divide-y divide-gray-200">
                @foreach ($serveis_adicional as $index => $serveis_adicional)
                <tr class="hover:bg-orange-50 transition">

                    <!-- Clickable cells (except actions) -->
                    <td class="px-6 py-4 text-gray-600 font-medium cursor-pointer"
                        onclick="window.location='{{ route('serveis_adicional.show', $serveis_adicional->id) }}'">
                        {{ $index + 1 }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-800 cursor-pointer"
                        onclick="window.location='{{ route('serveis_adicional.show', $serveis_adicional->id) }}'">
                        {{ $serveis_adicional->tipus }}
                    </td>

                    <td class="px-6 py-4 text-gray-600 cursor-pointer"
                        onclick="window.location='{{ route('serveis_adicional.show', $serveis_adicional->id) }}'">
                        {{ $serveis_adicional->contacte }}
                    </td>

                    <td class="px-6 py-4 text-gray-600 cursor-pointer"
                        onclick="window.location='{{ route('serveis_adicional.show', $serveis_adicional->id) }}'">
                        {{ $serveis_adicional->responsable }}
                    </td>


                    <!-- Actions column (no redirect) -->
                    <td class="px-6 py-4 flex space-x-3">

                        <!-- Edit button -->
                        <a href="{{ route('serveis_adicional.edit', $serveis_adicional) }}" 
                           class="text-orange-400 hover:text-orange-500 transition"
                           title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                                <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>

                        <!-- Delete / Toggle button -->
                        <form action="{{ route('serveis_adicional.destroy', $serveis_adicional) }}" method="POST">

                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-400 hover:text-red-500 transition"
                                    title="Eliminar">
                                <svg class="h-6 w-6" aria-label="Eliminar">
                                    <use href="{{ asset('icons/sprite.svg#icon-x') }}"></use>
                                </svg>
                            </button>
                        </form>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex space-x-4">
        <a href="{{ route('serveis_adicional.create') }}" 
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
           Afegir Servei Complementaris
        </a>

        <a href="{{ route('menu') }}" 
           class="inline-block px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl shadow-lg transition">
           Tornar al menú
        </a>
    </div>
</div>
@endsection
