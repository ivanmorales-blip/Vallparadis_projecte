@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
        <h1 class="text-3xl font-bold text-orange-500 mb-6">
            Afegir professionals al curs: <span class="text-gray-800">{{ $training->nom_curs }}</span>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Professionals disponibles -->
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-3">Professionals disponibles</h2>
                <ul id="available-professionals" 
                    class="bg-gray-100 p-4 rounded-xl min-h-[300px] space-y-2 shadow-inner"
                    ondragover="allowDrop(event)" ondrop="drop(event, 'available')">
                    @foreach($availableProfessionals as $prof)
                        <li draggable="true" ondragstart="drag(event)" 
                            data-id="{{ $prof->id }}"
                            class="p-3 bg-white rounded-lg shadow cursor-move hover:bg-orange-50 border border-gray-200 flex justify-between items-center">
                            <span>{{ $prof->nom }} {{ $prof->cognom }}</span>
                            <span class="text-gray-400 text-sm">{{ $prof->email }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Professionals assignats -->
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-3">Professionals assignats</h2>
                <ul id="assigned-professionals" 
                    class="bg-gray-100 p-4 rounded-xl min-h-[300px] space-y-2 shadow-inner"
                    ondragover="allowDrop(event)" ondrop="drop(event, 'assigned')">
                    @foreach($assignedProfessionals as $prof)
                        <li draggable="true" ondragstart="drag(event)" 
                            data-id="{{ $prof->id }}"
                            class="p-3 bg-white rounded-lg shadow cursor-move hover:bg-orange-50 border border-gray-200 flex justify-between items-center">
                            <span>{{ $prof->nom }} {{ $prof->cognom }}</span>
                            <span class="text-gray-400 text-sm">{{ $prof->email }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Botón guardar -->
        <div class="mt-8 text-right">
            <button id="save-btn" 
                    class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow transition">
                💾 Guardar canvis
            </button>
            <a href="{{ route('trainings.show', $training->id) }}" 
               class="ml-4 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl shadow transition">
                ⬅️ Tornar al curs
            </a>
        </div>
    </div>
</div>

<script>
let draggedItem = null;

function drag(event) {
    draggedItem = event.target;
}

function allowDrop(event) {
    event.preventDefault();
}

function drop(event, target) {
    event.preventDefault();
    const ul = document.getElementById(target === 'assigned' ? 'assigned-professionals' : 'available-professionals');
    ul.appendChild(draggedItem);
}

document.getElementById('save-btn').addEventListener('click', async () => {
    const assignedIds = Array.from(document.querySelectorAll('#assigned-professionals li')).map(li => li.dataset.id);

    const response = await fetch("{{ route('trainings.updateProfessionals', $training->id) }}", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ professionals: assignedIds }),
    });

    if (response.ok) {
        alert('Professionals actualitzats correctament!');
        window.location.href = "{{ route('trainings.show', $training->id) }}";
    } else {
        alert('Error al guardar els canvis.');
    }
});
</script>
@endsection
