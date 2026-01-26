@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">
        Llistat d'Accidentabilitats
    </h1>

    <div class="flex justify-center mb-6">
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">#</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Data</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Tipus</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Professional que emplena</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Context</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Descripció</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Durada</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Accions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($accidents as $accident)
                    <tr id="row-{{ $accident->id }}" 
                        class="hover:bg-orange-50 transition duration-200 cursor-pointer"
                        onclick="window.location='{{ route('accidentabilitat.show', $accident->id) }}'">

                        <!-- ID -->
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $accident->id }}</td>

                        <!-- Data -->
                        <td class="px-6 py-4 text-gray-700">{{ \Carbon\Carbon::parse($accident->data)->format('d/m/Y') }}</td>

                        <!-- Tipus -->
                        <td class="px-6 py-4 text-gray-700">
                            @if ($accident->tipus === 'sense_baixa')
                                Sense Baixa
                            @elseif ($accident->tipus === 'amb_baixa')
                                Amb Baixa
                            @else
                                {{ $accident->tipus }}
                            @endif
                        </td>

                        <!-- Professional que emplena -->
                        <td class="px-6 py-4 text-gray-700">
                            {{ optional($accident->professional)->nom ?? 'N/A' }}
                        </td>

                        <!-- Context -->
                        <td class="px-6 py-4 text-gray-700">{{ $accident->context }}</td>

                        <!-- Descripció -->
                        <td class="px-6 py-4 text-gray-700">{{ $accident->descripcio }}</td>

                        <!-- Durada -->
                        <td class="px-6 py-4 text-gray-700">{{ $accident->durada ?? '-' }}</td>

                        <!-- Accions -->
                        <td class="px-6 py-4 flex space-x-3" onclick="event.stopPropagation()">
                            <!-- Editar -->
                            <a href="{{ route('accidentabilitat.edit', $accident->id) }}" 
                               class="text-orange-400 hover:text-orange-500 transition" 
                               title="Editar" 
                               onclick="event.stopPropagation()">
                                <svg class="h-6 w-6" aria-label="Editar">
                                    <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                                </svg>
                            </a>

                            <!-- Eliminar -->
                            <form action="{{ route('accidentabilitat.destroy', $accident) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-500 transition" title="Eliminar"
                                        onclick="return confirm('Segur que vols eliminar aquest accident?')">
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

    <div class="mt-6 text-center">
        {{ $accidents->links() }}
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('menu') }}"
           class="inline-block px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl shadow-lg transition">
            Tornar al menú
        </a>
        <a href="{{ route('accidentabilitat.create') }}"
               class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-2xl shadow-md transition">
               Nou Accident
            </a>
    </div>
</div>
@endsection
