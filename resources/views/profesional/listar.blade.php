@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500">Listado de Profesionales</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
            <thead class="bg-orange-100">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-700 font-semibold uppercase">#</th>
                    <th class="text-left px-6 py-3 text-gray-700 font-semibold uppercase">Nombre</th>
                    <th class="text-left px-6 py-3 text-gray-700 font-semibold uppercase">Apellido</th>
                    <th class="text-left px-6 py-3 text-gray-700 font-semibold uppercase">Teléfono</th>
                    <th class="text-left px-6 py-3 text-gray-700 font-semibold uppercase">Email</th>
                    <th class="text-left px-6 py-3 text-gray-700 font-semibold uppercase">Dirección</th>
                    <th class="text-left px-6 py-3 text-gray-700 font-semibold uppercase">Estado</th>
                    <th class="text-left px-6 py-3 text-gray-700 font-semibold uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($profesional as $index => $prof)
                <tr class="hover:bg-orange-50 transition duration-200" id="row-{{ $prof->id }}">
                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">{{ $prof->nom }}</td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">{{ $prof->cognom }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $prof->telefon }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $prof->email }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $prof->adreça }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full font-semibold text-sm {{ $prof->estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}" id="status-{{ $prof->id }}">
                            {{ $prof->estat ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('profesional.edit', $prof) }}" class="text-white bg-orange-500 hover:bg-orange-600 px-3 py-2 rounded-lg shadow-md transition">
                            ✏️
                        </a>

                        <button class="toggle-status text-white px-3 py-2 rounded-lg shadow-md transition {{ $prof->estat ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}" data-id="{{ $prof->id }}">
                            {{ $prof->estat ? '🚫' : '✅' }}
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
document.querySelectorAll('.toggle-status').forEach(button => {
    button.addEventListener('click', function(e){
        e.preventDefault();
        const id = this.dataset.id;
        const isActive = this.classList.contains('bg-red-500'); // si está activo, botón rojo para desactivar
        const url = isActive ? `/profesional/${id}` : `/profesional/${id}/active`;

        fetch(url, {
            method: isActive ? 'DELETE' : 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                const statusEl = document.getElementById(`status-${id}`);
                statusEl.textContent = data.estat ? 'Activo' : 'Inactivo';
                statusEl.className = `px-2 py-1 rounded-full font-semibold text-sm ${data.estat ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800'}`;
                
                // Cambiar estilo del botón
                if(data.estat){
                    button.className = 'toggle-status text-white px-3 py-2 rounded-lg shadow-md transition bg-red-500 hover:bg-red-600';
                    button.textContent = '🚫';
                } else {
                    button.className = 'toggle-status text-white px-3 py-2 rounded-lg shadow-md transition bg-green-500 hover:bg-green-600';
                    button.textContent = '✅';
                }
            }
        });
    });
});
</script>
@endsection
