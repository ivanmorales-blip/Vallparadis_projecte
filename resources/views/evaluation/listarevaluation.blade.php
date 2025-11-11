@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">
        Llistat d'Evaluacions
    </h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">#</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Data</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Sumatori</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Observacions</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Arxiu</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Sumatori</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Profesional</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Profesional Avaluador</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Estat</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Accions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($evaluations as $evaluation)
                    <tr id="row-{{ $evaluation->id }}" data-id="{{ $evaluation->id }}" class="hover:bg-orange-50 transition duration-200">
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $evaluation->id }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $evaluation->data }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ number_format($evaluation->sumatori, 1) }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $evaluation->observacions }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $evaluation->arxiu}}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $evaluation->sumatori}}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $evaluation->profesional->nom ?? '' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $evaluation->profesionalAvaluador->nom ?? '' }}</td>

                        <td class="px-6 py-4">
                            <span class="estado px-2 py-1 rounded-full font-semibold text-sm {{ $evaluation->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ $evaluation->estat ? 'Actiu' : 'Inactiu' }}
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
            const evaluationId = row.dataset.id;
            const estadoCell = row.querySelector('.estado');

            const isActive = estadoCell.textContent.trim() === 'Actiu';
            const url = isActive
                ? `{{ url('evaluation') }}/${evaluationId}`           // DELETE / deactivate
                : `{{ url('evaluation') }}/${evaluationId}/active`;  // PATCH / activate
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
