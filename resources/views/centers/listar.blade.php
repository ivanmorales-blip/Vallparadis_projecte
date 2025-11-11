@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-400 text-center">Listado de Centros</h1>

    <div class="overflow-x-auto shadow-lg rounded-xl bg-white border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-50">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">#</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Dirección</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Estado</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($centers as $index => $center)
                <tr data-id="{{ $center->id }}" class="hover:bg-orange-50 transition duration-200">
                    <td class="px-6 py-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">{{ $center->nom }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $center->adreça }}</td>
                    <td class="px-6 py-4">
                        <span class="estado px-2 py-1 rounded-full text-sm {{ $center->activo ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $center->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-3">
                        <!-- Editar -->
                        <a href="{{ route('centers.edit', $center) }}" class="text-orange-400 hover:text-orange-500 transition" title="Editar">
                            <svg class="h-6 w-6" aria-label="Editar">
                            <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>
                        
                        <!-- Activar / Desactivar AJAX -->
                        <button class="activar-desactivar text-sm transition" title="{{ $center->activo ? 'Desactivar' : 'Activar' }}">
                            <svg class="h-6 w-6 {{ $center->activo ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}" aria-label="{{ $center->activo ? 'Desactivar' : 'Activar' }}">
                            <use href="{{ asset('icons/sprite.svg#' . ($center->activo ? 'icon-x' : 'icon-check')) }}"></use>
                            </svg>
                        </button>
                    </td>
                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('menu') }}" 
           class="inline-block px-6 py-3 bg-orange-400 hover:bg-orange-500 text-white rounded-xl shadow-lg transition">
           Volver a menú
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.activar-desactivar').forEach(button => {
        button.addEventListener('click', async function() {
            const row = this.closest('tr');
            const centerId = row.dataset.id;
            const estadoCell = row.querySelector('.estado');

            // Determinar la URL y método según el estado actual
            const activo = estadoCell.textContent.trim() === 'Activo';
            const url = activo ? `/centers/${centerId}` : `/centers/${centerId}/active`;
            const method = activo ? 'DELETE' : 'PATCH';

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
                    // Cambiar visualmente el estado
                    if (activo) {
                        estadoCell.textContent = 'Inactivo';
                        estadoCell.classList.remove('bg-green-100', 'text-green-700');
                        estadoCell.classList.add('bg-red-100', 'text-red-700');

                        this.querySelector('svg').classList.remove('text-red-400','hover:text-red-500');
                        this.querySelector('svg').classList.add('text-green-400','hover:text-green-500');
                        this.title = 'Activar';
                        this.querySelector('path').setAttribute('d', 'M5 13l4 4L19 7');
                    } else {
                        estadoCell.textContent = 'Activo';
                        estadoCell.classList.remove('bg-red-100','text-red-700');
                        estadoCell.classList.add('bg-green-100','text-green-700');

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
