@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-2xl p-10 border border-gray-200">

        <h1 class="text-4xl font-extrabold text-orange-500 mb-6 text-center">
            Afegir professionals al projecte: 
            <span class="text-gray-800">{{ $projecte->nom ?? $projecte->titol }}</span>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Professionals disponibles -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-2 flex justify-between items-center">
                    Professionals disponibles 
                    <span id="available-count" class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $availableProfessionals->count() }}
                    </span>
                </h2>
                <ul id="available-professionals" 
                    class="bg-gray-100 p-5 rounded-2xl min-h-[350px] space-y-3 shadow-inner overflow-y-auto max-h-[500px] scrollbar-thin scrollbar-thumb-orange-400 scrollbar-track-gray-200 transition-all"
                    ondragover="allowDrop(event)" ondrop="drop(event, 'available')">
                    @foreach($availableProfessionals as $prof)
                        <li draggable="true" ondragstart="drag(event)" 
                            data-id="{{ $prof->id }}"
                            class="p-4 bg-white rounded-2xl shadow hover:shadow-2xl transition-all cursor-move border border-gray-200 flex justify-between items-center hover:bg-orange-50 transform hover:-translate-y-0.5">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800">{{ $prof->nom }} {{ $prof->cognom }}</span>
                                <span class="text-gray-400 text-sm">{{ $prof->email }}</span>
                            </div>
                            <div class="text-gray-300 text-lg select-none">☰</div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Professionals assignats -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-2 flex justify-between items-center">
                    Professionals assignats 
                    <span id="assigned-count" class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $assignedProfessionals->count() }}
                    </span>
                </h2>
                <ul id="assigned-professionals" 
                    class="bg-gray-100 p-5 rounded-2xl min-h-[350px] space-y-3 shadow-inner overflow-y-auto max-h-[500px] scrollbar-thin scrollbar-thumb-orange-400 scrollbar-track-gray-200 transition-all"
                    ondragover="allowDrop(event)" ondrop="drop(event, 'assigned')">
                    @foreach($assignedProfessionals as $prof)
                        <li draggable="true" ondragstart="drag(event)" 
                            data-id="{{ $prof->id }}"
                            class="p-4 bg-white rounded-2xl shadow hover:shadow-2xl transition-all cursor-move border border-gray-200 flex justify-between items-center hover:bg-orange-50 transform hover:-translate-y-0.5">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800">{{ $prof->nom }} {{ $prof->cognom }}</span>
                                <span class="text-gray-400 text-sm">{{ $prof->email }}</span>
                            </div>
                            <div class="text-gray-300 text-lg select-none">☰</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Botón guardar -->
        <div class="mt-10 text-center md:text-right flex flex-col md:flex-row justify-end gap-4">
            <button id="save-btn" 
                    class="px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-2xl shadow-lg transition transform hover:-translate-y-0.5 hover:scale-105">
                💾 Guardar canvis
            </button>
            <a href="{{ route('projectes.show', $projecte->id) }}" 
               class="px-8 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-2xl shadow-lg transition transform hover:-translate-y-0.5 hover:scale-105">
                ⬅️ Tornar al projecte
            </a>
        </div>

        <!-- Toast notification -->
        <div id="toast" class="fixed bottom-6 right-6 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg opacity-0 transition-all"></div>
    </div>
</div>

<script src="{{ asset('js/dragdrop.js') }}"></script>
<script>
document.getElementById('save-btn').addEventListener('click', function() {
    saveDragDrop(
        "{{ route('projectes.updateProfessionals', $projecte->id) }}",
        "#assigned-professionals",
        "#assigned-count",
        "#available-count"
    );
});
</script>
@endsection
