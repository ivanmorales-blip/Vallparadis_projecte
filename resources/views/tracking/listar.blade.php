@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Listado de Seguiment</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">#</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Tipus</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Data</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Tema</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Comentari</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Profesional</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Registrador</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Estat</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">Accions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($tracking as $index => $tracking)
                <tr data-id="{{ $tracking->id }}" class="hover:bg-orange-50 transition duration-200">
                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">{{ $tracking->tipus }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $tracking->data }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $tracking->tema }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $tracking->comentari }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $tracking->id_profesional }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $tracking->id_profesional_registrador }}</td>
                    <td class="px-6 py-4">
                        <span class="estado px-2 py-1 rounded-full {{ $tracking->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}" id="status-{{ $tracking->id }}">
                            {{ $tracking->estat ? 'Actiu' : 'Inactiu' }}
                        </span>
                    </td>
                     <td class="px-6 py-4 flex space-x-3">
                        <!-- Editar -->
                        <a href="{{ route('tracking.edit', $tracking) }}" class="text-orange-400 hover:text-orange-500 transition" title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                            <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>
                        
                        <!-- Activar / Desactivar AJAX -->
                        <button class="activar-desactivar text-sm transition" title="{{ $tracking->activo ? 'Desactivar' : 'Activar' }}">
                            <svg class="h-6 w-6 {{ $tracking->activo ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}" aria-label="{{ $tracking->activo ? 'Desactivar' : 'Activar' }}">
                            <use href="{{ asset('icons/sprite.svg#' . ($tracking->activo ? 'icon-x' : 'icon-check')) }}"></use>
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 space-x-4">
    <a href="{{ route('menu') }}" class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
        Volver a menú
    </a>
</div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.activar-desactivar').forEach(button => {
        button.addEventListener('click', async function() {
            const row = this.closest('tr');
            const trackingId = row.dataset.id;
            const estadoCell = row.querySelector('.estado');

            // Determine current status based on 'estat'
            const isActive = estadoCell.textContent.trim() === 'Actiu';
            const url = isActive 
                ? `/tracking/${trackingId}`           // deactivate
                : `/tracking/${trackingId}/active`;  // activate
            const method = isActive ? 'DELETE' : 'PATCH';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    if (isActive) {
                        // Update the UI to show Inactive
                        estadoCell.textContent = 'Inactiu';
                        estadoCell.classList.remove('bg-green-200', 'text-green-800');
                        estadoCell.classList.add('bg-red-200', 'text-red-800');

                        this.querySelector('svg').classList.remove('text-red-400','hover:text-red-500');
                        this.querySelector('svg').classList.add('text-green-400','hover:text-green-500');
                        this.title = 'Activar';
                        this.querySelector('path').setAttribute('d', 'M5 13l4 4L19 7');
                    } else {
                        // Update the UI to show Active
                        estadoCell.textContent = 'Actiu';
                        estadoCell.classList.remove('bg-red-200','text-red-800');
                        estadoCell.classList.add('bg-green-200','text-green-800');

                        this.querySelector('svg').classList.remove('text-green-400','hover:text-green-500');
                        this.querySelector('svg').classList.add('text-red-400','hover:text-red-500');
                        this.title = 'Desactivar';
                        this.querySelector('path').setAttribute('d', 'M6 18L18 6M6 6l12 12');
                    }
                } else {
                    console.error('Error en la petición');
                }
            } catch (err) {
                console.error(err);
            }
        });
    });
});
</script>
@endsection
