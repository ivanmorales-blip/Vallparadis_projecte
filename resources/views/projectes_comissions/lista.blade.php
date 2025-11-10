@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">
        Llistat de Projectes i Comissions
    </h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">#</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Nom</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Tipus</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Data Inici</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Professional</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Centre</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Estat</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Accions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($projectes as $projecte)
                    <tr id="row-{{ $projecte->id }}" data-id="{{ $projecte->id }}" class="hover:bg-orange-50 transition duration-200">
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $projecte->id }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $projecte->nom }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $projecte->tipus }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $projecte->data_inici }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $projecte->profesional->nom ?? '' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $projecte->centre->nom ?? '' }}</td>

                        <td class="px-6 py-4">
                            <span class="estado px-2 py-1 rounded-full font-semibold text-sm {{ $projecte->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ $projecte->estat ? 'Actiu' : 'Inactiu' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 flex space-x-3">
                            <!-- Editar -->
                            <a href="{{ route('projectes_comissions.edit', $projecte) }}" class="text-orange-400 hover:text-orange-500 transition" title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-4-4l5-5m-5 5L9 7"/>
                                </svg>
                            </a>

                            <!-- Activar / Desactivar AJAX -->
                            <button class="activar-desactivar text-sm transition" title="{{ $projecte->estat ? 'Desactivar' : 'Activar' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $projecte->estat ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $projecte->estat ? 'M6 18L18 6M6 6l12 12' : 'M5 13l4 4L19 7' }}"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('menu') }}" class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
            Tornar al menú
        </a>
    </div>
</div>

{{-- AJAX --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.activar-desactivar').forEach(button => {
        button.addEventListener('click', async function() {
            const row = this.closest('tr');
            const projecteId = row.dataset.id;
            const estadoCell = row.querySelector('.estado');

            const isActive = estadoCell.textContent.trim() === 'Actiu';
            const url = isActive
                ? `{{ url('projectes_comissions') }}/${projecteId}`           // DELETE / deactivate
                : `{{ url('projectes_comissions') }}/${projecteId}/active`;  // PATCH / activate
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
                        estadoCell.textContent = 'Inactiu';
                        estadoCell.classList.replace('bg-green-200', 'bg-red-200');
                        estadoCell.classList.replace('text-green-800', 'text-red-800');

                        this.querySelector('svg').classList.replace('text-red-400','text-green-400');
                        this.querySelector('svg').classList.replace('hover:text-red-500','hover:text-green-500');
                        this.title = 'Activar';
                        this.querySelector('path').setAttribute('d','M5 13l4 4L19 7');
                    } else {
                        estadoCell.textContent = 'Actiu';
                        estadoCell.classList.replace('bg-red-200','bg-green-200');
                        estadoCell.classList.replace('text-red-800','text-green-800');

                        this.querySelector('svg').classList.replace('text-green-400','text-red-400');
                        this.querySelector('svg').classList.replace('hover:text-green-500','hover:text-red-500');
                        this.title = 'Desactivar';
                        this.querySelector('path').setAttribute('d','M6 18L18 6M6 6l12 12');
                    }
                } else {
                    console.error('Error en la petición AJAX');
                }
            } catch (err) {
                console.error(err);
            }
        });
    });
});
</script>
@endsection

 