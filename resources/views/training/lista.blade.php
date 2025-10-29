<!-- lista.blade.php -->
@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Llistat de Cursos</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700">#</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-700 uppercase">Nom</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-700 uppercase">Data Inici</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-700 uppercase">Data Fi</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-700 uppercase">Formador</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-700 uppercase">Centre</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-700 uppercase">Estat</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-700 uppercase">Accions</th>
                </tr>
            </thead>
            <tbody id="cursos-table" class="divide-y divide-gray-200">
                @foreach ($trainings as $index => $training)
                <tr id="training-{{ $training->id }}" class="hover:bg-orange-50 transition">
                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $training->nom_curs }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $training->data_inici }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $training->data_fi }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $training->formador }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $training->center->nom ?? '' }}</td>
                    <td class="px-6 py-4">
                        <span class="estado px-2 py-1 rounded-full text-sm font-semibold {{ $training->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $training->estat ? 'Actiu' : 'Inactiu' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-3">
                        <!-- Editar -->
                        <a href="{{ route('trainings.edit', $training) }}" class="text-orange-400 hover:text-orange-500 transition" title="Editar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-4-4l5-5m-5 5L9 7"/>
                            </svg>
                        </a>

                        <!-- Activar / Desactivar AJAX -->
                        <button class="activar-desactivar text-sm transition" data-id="{{ $training->id }}" title="{{ $training->estat ? 'Desactivar' : 'Activar' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $training->estat ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $training->estat ? 'M6 18L18 6M6 6l12 12' : 'M5 13l4 4L19 7' }}"/>
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('menu') }}" class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">Volver a menú</a>
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
                        estadoCell.classList.remove('bg-green-200','text-green-800');
                        estadoCell.classList.add('bg-red-200','text-red-800');
                        this.querySelector('svg').classList.remove('text-red-400','hover:text-red-500');
                        this.querySelector('svg').classList.add('text-green-400','hover:text-green-500');
                        this.title = 'Activar';
                        this.querySelector('path').setAttribute('d','M5 13l4 4L19 7');
                    } else {
                        estadoCell.textContent = 'Actiu';
                        estadoCell.classList.remove('bg-red-200','text-red-800');
                        estadoCell.classList.add('bg-green-200','text-green-800');
                        this.querySelector('svg').classList.remove('text-green-400','hover:text-green-500');
                        this.querySelector('svg').classList.add('text-red-400','hover:text-red-500');
                        this.title = 'Desactivar';
                        this.querySelector('path').setAttribute('d','M6 18L18 6M6 6l12 12');
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
