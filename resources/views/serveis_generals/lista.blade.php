@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Llistat de Serveis Generals</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">#</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Tipus</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Contacte</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Encarregat</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Centre</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Accions</th>
                </tr>
            </thead>

            <tbody id="services-table" class="divide-y divide-gray-200">
                @foreach ($services as $index => $service)
                <tr class="hover:bg-orange-50 transition">

                    <!-- Clickable cells (except actions) -->
                    <td class="px-6 py-4 text-gray-600 font-medium cursor-pointer"
                        onclick="window.location='{{ route('general_services.show', $service->id) }}'">
                        {{ $index + 1 }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-800 cursor-pointer"
                        onclick="window.location='{{ route('general_services.show', $service->id) }}'">
                        {{ $service->tipus }}
                    </td>

                    <td class="px-6 py-4 text-gray-600 cursor-pointer"
                        onclick="window.location='{{ route('general_services.show', $service->id) }}'">
                        {{ $service->contacte }}
                    </td>

                    <td class="px-6 py-4 text-gray-600 cursor-pointer"
                        onclick="window.location='{{ route('general_services.show', $service->id) }}'">
                        {{ $service->encarregat }}
                    </td>

                    <td class="px-6 py-4 text-gray-700 cursor-pointer"
                        onclick="window.location='{{ route('general_services.show', $service->id) }}'">
                        {{ $service->center->nom ?? '—' }}
                    </td>

                    <!-- Actions column (no redirect) -->
                    <td class="px-6 py-4 flex space-x-3">

                        <!-- Edit button -->
                        <a href="{{ route('general_services.edit', $service) }}" 
                           class="text-orange-400 hover:text-orange-500 transition"
                           title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                                <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>

                        <!-- Delete / Toggle button -->
                        <form action="{{ route('general_services.destroy', $service) }}" 
                              method="POST" onsubmit="return confirm('Segur que vols eliminar aquest servei?')">
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
        <a href="{{ route('general_services.create') }}" 
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
           Afegir Servei General
        </a>

        <a href="{{ route('menu') }}" 
           class="inline-block px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl shadow-lg transition">
           Tornar al menú
        </a>
    </div>
</div>
@endsection
