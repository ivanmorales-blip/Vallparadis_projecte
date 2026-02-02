@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">Listado de Profesionales</h1>

    <!-- Buscador -->
    <div class="mb-4">
        <input type="text" id="searchInput" placeholder="Buscar por nombre..."
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-orange-400">
    </div>

    <div class="overflow-x-auto">
        <table id="profesionalTable" class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
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
                        @php
                            $colorClass = match($profesionalItem->estat) {
                                'actiu', 'suplencia habitual' => 'bg-green-200 text-green-800',
                                'baixa' => 'bg-red-200 text-red-800',
                                default => 'bg-gray-200 text-gray-800',
                            };
                            $estatText = match($profesionalItem->estat) {
                                'actiu' => 'Actiu',
                                'suplencia habitual' => 'Suplencia habitual',
                                'baixa' => 'Baixa',
                                default => $profesionalItem->estat,
                            };
                        @endphp
                        <span class="estado px-2 py-1 rounded-full {{ $colorClass }}">
                            {{ $estatText }}
                        </span>
                    </td>

                    <td class="px-6 py-4 flex space-x-3" onclick="event.stopPropagation()">
                        <!-- Editar -->
                        <a href="{{ route('profesional.edit', $profesionalItem) }}" class="text-orange-400 hover:text-orange-500 transition" title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                                <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>
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

<!-- Script de búsqueda -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('searchInput');
    const tableBody = document.querySelector('#profesionalTable tbody');
    const ICON_SPRITE = '/icons/sprite.svg';

    function renderEstat(estat) {
        let colorClass = 'bg-gray-200 text-gray-800';
        let text = estat;

        switch (estat) {
            case 'actiu':
                colorClass = 'bg-green-200 text-green-800';
                text = 'Actiu';
                break;
            case 'suplencia habitual':
                colorClass = 'bg-green-200 text-green-800';
                text = 'Suplencia habitual';
                break;
            case 'baixa':
                colorClass = 'bg-red-200 text-red-800';
                text = 'Baixa';
                break;
        }

        return `<span class="px-2 py-1 rounded-full ${colorClass}">${text}</span>`;
    }

    input.addEventListener('input', function() {
        const query = input.value.trim();

        fetch(`/profesionales/search?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(profesionales => {
                tableBody.innerHTML = '';

                if (!profesionales.length) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="8" class="text-center text-gray-500 py-4">
                                No se encontraron profesionales
                            </td>
                        </tr>
                    `;
                    return;
                }

                profesionales.forEach((p, i) => {
                    tableBody.innerHTML += `
                        <tr class="hover:bg-orange-50 cursor-pointer"
                            onclick="window.location='/profesional/${p.id}'">
                            <td class="px-6 py-4">${i + 1}</td>
                            <td class="px-6 py-4 font-semibold">${p.nom}</td>
                            <td class="px-6 py-4">${p.cognom}</td>
                            <td class="px-6 py-4">${p.telefon || ''}</td>
                            <td class="px-6 py-4">${p.email || ''}</td>
                            <td class="px-6 py-4">${p.adreça || ''}</td>
                            <td class="px-6 py-4">${renderEstat(p.estat)}</td>
                            <td class="px-6 py-4" onclick="event.stopPropagation()">
                                <a href="/profesional/${p.id}/edit"
                                   class="text-orange-400 hover:text-orange-500"
                                   title="Editar">
                                    <svg class="h-6 w-6">
                                        <use href="${ICON_SPRITE}#icon-edit"></use>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(err => console.error('Error en búsqueda:', err));
    });
});
</script>
@endsection
