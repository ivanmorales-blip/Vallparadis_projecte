@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">Llistat de Projectes i Comissions</h1>

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
                    <tr id="row-{{ $projecte->id }}" class="hover:bg-orange-50 transition duration-200">
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $projecte->id }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $projecte->nom }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $projecte->tipus }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $projecte->data_inici }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $projecte->profesional->nom ?? '' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $projecte->centre->nom ?? '' }}</td>

                        <td class="px-6 py-4" id="status-{{ $projecte->id }}">
                            @if ($projecte->estat)
                                <span class="px-2 py-1 rounded-full bg-green-200 text-green-800 font-semibold text-sm">Actiu</span>
                            @else
                                <span class="px-2 py-1 rounded-full bg-red-200 text-red-800 font-semibold text-sm">Inactiu</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 flex items-center space-x-3">
                            <!-- Botón Editar -->
                            <a href="{{ route('projectes_comissions.edit', $projecte) }}"
                                class="text-blue-500 hover:text-blue-700 transition">
                                <i class="fas fa-edit text-lg"></i>
                            </a>

                            <!-- Botón Activar/Desactivar -->
                            <button
                                class="toggle-status"
                                data-id="{{ $projecte->id }}"
                                data-status="{{ $projecte->estat ? '1' : '0' }}">
                                @if ($projecte->estat)
                                    <i class="fas fa-toggle-on text-green-500 hover:text-green-600 text-2xl"></i>
                                @else
                                    <i class="fas fa-toggle-off text-gray-400 hover:text-orange-400 text-2xl"></i>
                                @endif
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('menu') }}"
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
            Tornar al menú
        </a>
    </div>
</div>

{{-- FontAwesome para los íconos --}}
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

{{-- AJAX --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.toggle-status');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const currentStatus = this.dataset.status;
            const newStatus = currentStatus === '1' ? 0 : 1;

            fetch(`/projectes_comissions/${id}/${newStatus ? 'active' : 'destroy'}`, {
                method: newStatus ? 'PATCH' : 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const statusCell = document.getElementById(`status-${id}`);
                    const icon = this.querySelector('i');

                    // Actualizar el estado visual
                    if (newStatus) {
                        statusCell.innerHTML = '<span class="px-2 py-1 rounded-full bg-green-200 text-green-800 font-semibold text-sm">Actiu</span>';
                        icon.className = 'fas fa-toggle-on text-green-500 hover:text-green-600 text-2xl';
                        this.dataset.status = '1';
                    } else {
                        statusCell.innerHTML = '<span class="px-2 py-1 rounded-full bg-red-200 text-red-800 font-semibold text-sm">Inactiu</span>';
                        icon.className = 'fas fa-toggle-off text-gray-400 hover:text-orange-400 text-2xl';
                        this.dataset.status = '0';
                    }
                }
            })
            .catch(err => console.error('Error:', err));
        });
    });
});
</script>
@endsection
