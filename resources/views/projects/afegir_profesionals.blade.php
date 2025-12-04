@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-br from-orange-100 via-white to-orange-200 p-10">

    <div class="max-w-7xl mx-auto rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.15)] backdrop-blur-2xl bg-white/70 border border-white/40 p-12 transition-all">

        <!-- Title -->
        <h1 class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-700 mb-10 text-center drop-shadow-sm">
            Afegir professionals al projecte  
            <span class="block text-gray-900">{{ $projecte->nom ?? $projecte->titol }}</span>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

            <!-- Available -->
            <div class="transform transition-all hover:scale-[1.01]">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3 flex justify-between items-center">
                    Professionals disponibles

                    <span id="available-count"
                        class="px-3 py-1 rounded-full text-sm font-bold bg-gray-200/70 backdrop-blur-md text-gray-700 shadow-inner">
                        {{ $availableProfessionals->count() }}
                    </span>
                </h2>

                <ul id="available-professionals"
                    class="bg-white/60 backdrop-blur-xl border border-gray-300/40 p-5 rounded-3xl min-h-[380px] space-y-4 shadow-inner overflow-y-auto max-h-[520px] smooth-scroll premium-list"
                    ondragover="allowDrop(event)" ondrop="drop(event, 'available')">

                    @foreach($availableProfessionals as $prof)
                        <li draggable="true" ondragstart="drag(event)" data-id="{{ $prof->id }}"
                            class="flex justify-between items-center p-4 rounded-2xl bg-white/90 hover:bg-orange-50 border border-gray-200 shadow-md hover:shadow-xl transition-all cursor-move transform hover:-translate-y-1 backdrop-blur">
                            
                            <div>
                                <span class="font-semibold text-gray-800 block text-lg">{{ $prof->nom }} {{ $prof->cognom }}</span>
                                <span class="text-gray-500 text-sm">{{ $prof->email }}</span>
                            </div>

                            <div class="text-gray-300 text-xl">☰</div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Assigned -->
            <div class="transform transition-all hover:scale-[1.01]">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3 flex justify-between items-center">
                    Professionals assignats

                    <span id="assigned-count"
                        class="px-3 py-1 rounded-full text-sm font-bold bg-orange-100/80 backdrop-blur-md text-orange-700 shadow-inner">
                        {{ $assignedProfessionals->count() }}
                    </span>
                </h2>

                <ul id="assigned-professionals"
                    class="bg-white/60 backdrop-blur-xl border border-gray-300/40 p-5 rounded-3xl min-h-[380px] space-y-4 shadow-inner overflow-y-auto max-h-[520px] smooth-scroll premium-list"
                    ondragover="allowDrop(event)" ondrop="drop(event, 'assigned')">

                    @foreach($assignedProfessionals as $prof)
                        <li draggable="true" ondragstart="drag(event)" data-id="{{ $prof->id }}"
                            class="flex justify-between items-center p-4 rounded-2xl bg-white/90 hover:bg-orange-50 border border-gray-200 shadow-md hover:shadow-xl transition-all cursor-move transform hover:-translate-y-1 backdrop-blur">
                            
                            <div>
                                <span class="font-semibold text-gray-800 block text-lg">{{ $prof->nom }} {{ $prof->cognom }}</span>
                                <span class="text-gray-500 text-sm">{{ $prof->email }}</span>
                            </div>

                            <div class="text-gray-300 text-xl">☰</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-12 flex flex-col md:flex-row justify-end gap-5">

            <button id="save-btn"
                class="px-10 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:from-orange-600 hover:to-orange-700 transition-all transform hover:-translate-y-1 hover:scale-105">
                💾 Guardar canvis
            </button>

            <a href="{{ route('projectes.show', $projecte->id) }}"
               class="px-10 py-4 bg-gray-300/70 backdrop-blur-lg border border-gray-300 rounded-2xl text-gray-800 shadow-md hover:bg-gray-400 hover:shadow-xl transition-all transform hover:-translate-y-1 hover:scale-105">
                ⬅️ Tornar al projecte
            </a>
        </div>

        <!-- Toast -->
        <div id="toast"
             class="fixed bottom-8 right-8 bg-green-500 text-white px-8 py-4 rounded-xl shadow-2xl opacity-0 transition-all backdrop-blur-xl border border-white/30">
        </div>

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
