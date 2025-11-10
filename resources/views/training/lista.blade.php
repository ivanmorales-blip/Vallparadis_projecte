@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Llistat de Cursos</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">#</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Nom</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Data Inici</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Data Fi</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Formador</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Centre</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Estat</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Accions</th>
                </tr>
            </thead>
            <tbody id="cursos-table" class="divide-y divide-gray-200">
                @foreach ($trainings as $index => $training)
                <tr id="training-{{ $training->id }}" 
                    class="hover:bg-orange-50 transition cursor-pointer"
                    onclick="window.location='{{ route('trainings.show', $training->id) }}'">

                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $training->nom_curs }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($training->data_inici)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($training->data_fi)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $training->formador }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $training->center->nom ?? '—' }}</td>

                    <td class="px-6 py-4">
                        <span class="estado px-2 py-1 rounded-full text-sm font-semibold {{ $training->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $training->estat ? 'Actiu' : 'Inactiu' }}
                        </span>
                    </td>

                    <td class="px-6 py-4 flex space-x-3"
                        onclick="event.stopPropagation()"> <!-- evita que el click del tr afecte a los botones -->

                        <!-- Editar curso -->
                        <a href="{{ route('trainings.edit', $training->id) }}" 
                           class="text-orange-400 hover:text-orange-600 transition" title="Editar curs">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-4-4l5-5m-5 5L9 7"/>
                            </svg>
                        </a>

                        <!-- Activar / Desactivar AJAX -->
                        <button class="activar-desactivar" data-id="{{ $training->id }}" title="{{ $training->estat ? 'Desactivar' : 'Activar' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-6 w-6 {{ $training->estat ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="{{ $training->estat ? 'M6 18L18 6M6 6l12 12' : 'M5 13l4 4L19 7' }}"/>
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('export.cursos') }}" class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
        Exportar Cursos Excel
        </a>
        <a href="{{ route('menu') }}" 
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
           Volver a menú
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.activar-desactivar').forEach(button => {
        button.addEventListener('click', async function() {
            const trainingId = this.dataset.id;
            const row = this.closest('tr');
            const estadoCell = row.querySelector('.estado');
            const activo = estadoCell.textContent.trim() === 'Actiu';
            const url = activo ? `/trainings/${trainingId}` : `/trainings/${trainingId}/active`;
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
                    if (activo) {
                        estadoCell.textContent = 'Inactiu';
                        estadoCell.classList.replace('bg-green-200', 'bg-red-200');
                        estadoCell.classList.replace('text-green-800', 'text-red-800');
                        this.querySelector('svg').classList.replace('text-red-400', 'text-green-400');
                        this.querySelector('svg').classList.replace('hover:text-red-500', 'hover:text-green-500');
                        this.querySelector('path').setAttribute('d', 'M5 13l4 4L19 7');
                        this.title = 'Activar';
                    } else {
                        estadoCell.textContent = 'Actiu';
                        estadoCell.classList.replace('bg-red-200', 'bg-green-200');
                        estadoCell.classList.replace('text-red-800', 'text-green-800');
                        this.querySelector('svg').classList.replace('text-green-400', 'text-red-400');
                        this.querySelector('svg').classList.replace('hover:text-green-500', 'hover:text-red-500');
                        this.querySelector('path').setAttribute('d', 'M6 18L18 6M6 6l12 12');
                        this.title = 'Desactivar';
                    }
                }
            } catch (err) {
                console.error('Error:', err);
            }
        });
    });
});
</script>
@endsection
