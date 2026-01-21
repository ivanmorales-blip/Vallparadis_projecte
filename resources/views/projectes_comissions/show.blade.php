@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl p-10 border border-gray-200 relative">

        <!-- Header: Título y tipo -->
        <div class="flex justify-between items-start mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-orange-500">
                {{ $projecte->nom }}
            </h1>

            <!-- Tipo Projecte -->
            <div class="ml-4 flex items-center">
                <span class="bg-blue-200 text-blue-500 px-5 py-2 rounded-full font-semibold text-sm shadow-lg animate-pulse">
                    Comissió
                </span>
            </div>
        </div>

        <!-- Información principal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-700 mb-8">
            <div class="space-y-4 p-5 bg-gray-50 rounded-xl border border-gray-200 shadow-inner">
                <p><span class="font-semibold">Data inici:</span> {{ \Carbon\Carbon::parse($projecte->data_inici)->format('d/m/Y') }}</p>
                <p><span class="font-semibold">Professional responsable:</span> {{ $projecte->profesional->nom ?? '—' }} {{ $projecte->profesional->cognom ?? '' }}</p>
                <p><span class="font-semibold">Centre:</span> {{ $projecte->centre->nom ?? '—' }}</p>
            </div>
            <div class="space-y-4 p-5 bg-gray-50 rounded-xl border border-gray-200 shadow-inner">
                <p><span class="font-semibold">Descripció:</span> {{ $projecte->descripcio ?? '—' }}</p>
                <p><span class="font-semibold">Observacions:</span> {{ $projecte->observacions ?? '—' }}</p>
            </div>
        </div>

        <!-- Profesionales asignados -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Professionals assignats</h2>

            @if($projecte->professionals->isEmpty())
                <p class="text-gray-500 italic">No hi ha professionals assignats a aquest projecte.</p>
            @else
                <ul id="assigned-professionals"
                    class="space-y-3 max-h-72 overflow-y-auto scrollbar-thin scrollbar-thumb-blue-400 scrollbar-track-gray-200 pr-2">
                    @foreach($projecte->professionals as $prof)
                        <li class="p-4 bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-xl transition-all duration-300 flex justify-between items-center"
                            data-id="{{ $prof->id }}">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $prof->nom }} {{ $prof->cognom }}</p>
                                <p class="text-sm text-gray-500">{{ $prof->email }}</p>
                            </div>
                            <div class="text-gray-300 text-lg select-none cursor-move">☰</div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Botones -->
        <div class="flex flex-wrap justify-between gap-4 mt-10">

            <!-- Volver al listado -->
            <a href="{{ route('projectes_comissions.projectes') }}" 
               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-2xl shadow-lg 
                      transition-all transform hover:-translate-y-0.5 hover:scale-105">
                Tornar al llistat
            </a>

            <!-- Gestionar profesionales -->
            <a href="{{ route('projectes_comissions.addProfessionals', $projecte->id) }}"
               class="px-6 py-3 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 
                      text-white font-bold rounded-2xl shadow-xl transition-all transform hover:-translate-y-1 hover:scale-105">
                Afegir Professionals
            </a>

            <!-- Editar Projecte -->
            <a href="{{ route('projectes_comissions.edit', $projecte->id) }}" 
               class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 
                      text-white font-medium rounded-2xl shadow-lg transition-all transform hover:-translate-y-0.5 hover:scale-105">
                Editar Projecte
            </a>

        </div>

        <!-- Toast notification -->
        <div id="toast" class="fixed bottom-6 right-6 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg opacity-0 transition-all"></div>

    </div>
</div>

<script src="{{ asset('js/dragdrop.js') }}"></script>
<script>
    // Inicializar contadores si quieres mostrar número de assignats
    document.addEventListener('DOMContentLoaded', () => {
        const assignedUL = document.getElementById('assigned-professionals');
        if (assignedUL) {
            const assignedCount = document.createElement('span');
            assignedCount.id = 'assigned-count';
            assignedCount.textContent = assignedUL.querySelectorAll('li').length;
            assignedUL.before(assignedCount); // Opcional, muestra contador arriba
        }
    });
</script>
@endsection
