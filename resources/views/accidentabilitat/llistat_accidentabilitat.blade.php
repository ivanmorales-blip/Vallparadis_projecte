@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-orange-500">Accidentabilitat</h1>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Data</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Tipus</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Centre</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Professional</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Estat</th>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase text-sm">Accions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($accidents as $accident)
                    <tr class="hover:bg-orange-50 transition cursor-pointer"
                        onclick="window.location='{{ route('accidentabilitat.show', $accident) }}'">

                        <!-- Data -->
                        <td class="px-6 py-4 text-gray-700">
                            {{ \Carbon\Carbon::parse($accident->data_accident)->format('d/m/Y') }}
                        </td>

                        <!-- Tipus -->
                        <td class="px-6 py-4 text-gray-700">
                            {{ $accident->tipus === 'amb_baixa' ? 'Amb baixa' : 'Sense baixa' }}
                        </td>

                        <!-- Centre -->
                        <td class="px-6 py-4 text-gray-700">
                            {{ $accident->centre->nom ?? '-' }}
                        </td>

                        <!-- Professional -->
                        <td class="px-6 py-4 text-gray-700">
                            {{ $accident->professional->nom ?? '-' }}
                        </td>

                        <!-- Estat -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $accident->estat === 'activa' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                {{ ucfirst($accident->estat) }}
                            </span>
                        </td>

                        <!-- Accions -->
                        <td class="px-6 py-4 flex space-x-3" onclick="event.stopPropagation()">
                            <!-- Veure -->
                            <a href="{{ route('accidentabilitat.show', $accident) }}"
                               class="text-blue-500 hover:text-blue-600 transition"
                               title="Veure">
                                <svg class="h-5 w-5" aria-hidden="true">
                                    <use href="{{ asset('icons/sprite.svg#icon-eye') }}"></use>
                                </svg>
                            </a>

                            <!-- Editar -->
                            <a href="{{ route('accidentabilitat.edit', $accident) }}"
                               class="text-yellow-500 hover:text-yellow-600 transition"
                               title="Editar">
                                <svg class="h-5 w-5" aria-hidden="true">
                                    <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                                </svg>
                            </a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                            No hi ha accidents registrats
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginació -->
    <div class="mt-6">
        {{ $accidents->links() }}
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('menu') }}"
           class="inline-block px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl shadow-lg transition">
            Tornar al menú
        </a>

        <a href="{{ route('accidentabilitat.create') }}"
            class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
            + Alta accident
        </a>
    </div>

</div>
@endsection
