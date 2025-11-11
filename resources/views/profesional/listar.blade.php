@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Listado de Profesionales</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
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
                @foreach ($profesional as $index => $profesional)
                <tr data-id="{{ $profesional->id }}" class="hover:bg-orange-50 transition duration-200">
                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">{{ $profesional->nom }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $profesional->cognom }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $profesional->telefon }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $profesional->email }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $profesional->adreça }}</td>
                    <td class="px-6 py-4">
                        <span class="estado px-2 py-1 rounded-full {{ $profesional->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}" id="status-{{ $profesional->id }}">
                            {{ $profesional->estat ? 'Actiu' : 'Inactiu' }}
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

    <div class="mt-6 space-x-4">
    <a href="{{ route('export.taquilla') }}" class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
        Exportar Taquilla Excel
    </a>
    <a href="{{ route('export.uniform') }}" class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
        Exportar Uniform Excel
    </a>
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
            const profesionalId = row.dataset.id;
            const estadoCell = row.querySelector('.estado');

            // Determine current status based on 'estat'
            const isActive = estadoCell.textContent.trim() === 'Actiu';
            const url = isActive 
                ? `/profesional/${profesionalId}`           // deactivate
                : `/profesional/${profesionalId}/active`;  // activate
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
