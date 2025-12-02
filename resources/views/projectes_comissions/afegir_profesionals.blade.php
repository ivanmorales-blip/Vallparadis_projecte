@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-8 border border-gray-200">

        <h1 class="text-3xl font-bold text-purple-500 mb-6">
            Afegir professionals al {{ strtolower($projecte->tipus) }}: 
            <span class="text-gray-800">{{ $projecte->nom }}</span>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 h-[500px] overflow-y-auto">
            <!-- Professionals disponibles -->
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-3">Professionals disponibles</h2>
                <ul id="available-professionals" 
                    class="bg-gray-100 p-4 rounded-xl min-h-[300px] space-y-2 shadow-inner overflow-y-auto"
                    ondragover="allowDrop(event)" ondrop="drop(event, 'available')">
                    @foreach($availableProfessionals as $prof)
                        <li draggable="true" ondragstart="drag(event)" 
                            data-id="{{ $prof->id }}"
                            class="p-3 bg-white rounded-lg shadow cursor-move hover:bg-purple-50 border border-gray-200 flex justify-between items-center">
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
                    class="bg-gray-100 p-4 rounded-xl min-h-[300px] space-y-2 shadow-inner overflow-y-auto"
                    ondragover="allowDrop(event)" ondrop="drop(event, 'assigned')">
                    @foreach($assignedProfessionals as $prof)
                        <li draggable="true" ondragstart="drag(event)" 
                            data-id="{{ $prof->id }}"
                            class="p-3 bg-white rounded-lg shadow cursor-move hover:bg-purple-50 border border-gray-200 flex justify-between items-center">
                            <span>{{ $prof->nom }} {{ $prof->cognom }}</span>
                            <span class="text-gray-400 text-sm">{{ $prof->email }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Botones -->
        <div class="mt-8 text-right flex flex-wrap justify-end gap-4">
            <button id="save-btn" class="px-6 py-3 bg-purple-500 hover:bg-purple-600 text-white rounded-xl shadow transition">
                💾 Guardar canvis
            </button>
            <a href="{{ url()->previous() }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl shadow transition">
                ⬅️ Tornar
            </a>
        </div>
    </div>
</div>

<script src="{{ asset('js/dragdrop.js') }}"></script>
<script>
document.getElementById('save-btn').addEventListener('click', function() {
    saveDragDrop(
        "{{ route('projectes_comissions.updateProfessionals', $projecte->id) }}",
        "#assigned-professionals"
    );
});
</script>
@endsection
