@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-7xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-gray-200">

        <!-- Header: Nombre y Estado -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
            <div>
                <h1 class="text-4xl font-extrabold text-orange-500">
                    {{ $profesional->nom }} {{ $profesional->cognom }}
                </h1>
                <p class="text-gray-500 mt-1 text-lg">Perfil del professional</p>
            </div>
            <span class="mt-4 md:mt-0 px-5 py-2 rounded-full text-sm font-semibold 
                {{ $profesional->estat ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $profesional->estat ? 'Actiu' : 'Inactiu' }}
            </span>
        </div>

        <!-- Información General -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-700 mb-8">
            <div class="space-y-3 p-4 bg-gray-50 rounded-xl shadow-inner border border-gray-200">
                <p><span class="font-semibold text-gray-800">Telèfon:</span> {{ $profesional->telefon ?? '—' }}</p>
                <p><span class="font-semibold text-gray-800">Email:</span> {{ $profesional->email ?? '—' }}</p>
                <p><span class="font-semibold text-gray-800">Taquilla:</span> {{ $profesional->taquilla ?? '—' }}</p>
            </div>
            <div class="space-y-3 p-4 bg-gray-50 rounded-xl shadow-inner border border-gray-200">
                <p><span class="font-semibold text-gray-800">Adreça:</span> {{ $profesional->adreça ?? '—' }}</p>
                <p><span class="font-semibold text-gray-800">Centre:</span> {{ $profesional->center->nom ?? '—' }}</p>
            </div>
            <div class="space-y-3 p-4 bg-gray-50 rounded-xl shadow-inner border border-gray-200">
                <p class="font-semibold text-gray-800">Talles:</p>
                <ul class="ml-4 text-gray-600">
                    <li>Samarreta: {{ $profesional->talla_samarreta ?? '—' }}</li>
                    <li>Pantalons: {{ $profesional->talla_pantalons ?? '—' }}</li>
                    <li>Sabates: {{ $profesional->talla_sabates ?? '—' }}</li>
                </ul>
            </div>
        </div>

        <!-- Gestión: Crear Seguiment / Avaluació -->
        <div class="mt-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">Gestió</h2>
            <div class="bg-gray-50 p-6 rounded-xl shadow-inner flex flex-col md:flex-row md:space-x-6 space-y-2 md:space-y-0">
                <a href="{{ route('tracking.profesional.create', ['profesional' => $profesional->id]) }}"
                    class="px-4 py-2 bg-orange-100 text-orange-700 rounded-xl font-medium shadow hover:bg-orange-200 transition">
                    Donar d'alta Seguiment
                </a>

                <a href="{{ route('evaluation.create', ['from_profesional' => $profesional->id]) }}"
                    class="px-4 py-2 bg-orange-100 text-orange-700 rounded-xl font-medium shadow hover:bg-orange-200 transition">
                    Donar d'alta Avaluació
                </a>

                <a href="{{ route('documentacioprofesional.create', ['profesional' => $profesional->id]) }}"
                class="px-4 py-2 bg-orange-100 text-orange-700 rounded-xl font-medium shadow hover:bg-orange-200 transition">
                    Afegir Documentació
                </a>

                 <a href="{{ route('accidentabilitat.create', ['profesional' => $profesional->id]) }}"
                class="px-4 py-2 bg-orange-100 text-orange-700 rounded-xl font-medium shadow hover:bg-orange-200 transition">
                    Afegir Accidentabilitat
                </a>

            </div>
        </div>

        <!-- Seguiments y Avaluacions lado a lado -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <!-- Seguiments -->
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">Seguiments</h2>

                @if($profesional->trackings->isEmpty())
                    <p class="text-gray-500 italic">Encara no hi ha seguiments registrats.</p>
                @else
                    <ul class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                        @foreach($profesional->trackings as $tracking)
                            <li 
                                onclick="window.location='{{ route('tracking.profesional.show', $tracking->id) }}'"
                                class="p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-100 transition cursor-pointer"
                            >
                                <div class="space-y-1">
                                    <div class="font-semibold text-orange-600 text-lg">
                                        {{ $tracking->tema ?? 'Seguiment sense títol' }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($tracking->data)->format('d/m/Y') }}
                                    </div>
                                    <div class="text-sm text-gray-700">
                                        <span class="font-semibold">Tipus:</span> {{ $tracking->tipus ?? '—' }}
                                    </div>
                                    <div class="text-sm text-gray-700">
                                        <span class="font-semibold">Avaluador:</span> {{ optional($tracking->registrador)->nom }} {{ optional($tracking->registrador)->cognom }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Avaluacions -->
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">Avaluacions</h2>

                @if($profesional->evaluations->isEmpty())
                    <p class="text-gray-500 italic">Encara no hi ha avaluacions registrades.</p>
                @else
                    <ul class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                        @foreach($profesional->evaluations as $evaluation)
                            <li class="cursor-pointer p-3 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-50 transition"
                                onclick="window.location='{{ route('evaluation.show', $evaluation->id) }}'">
                                <div class="flex flex-col space-y-1">
                                    <p class="font-medium text-orange-600">
                                        Avaluació del {{ \Carbon\Carbon::parse($evaluation->data)->format('d/m/Y') }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Avaluador: {{ $evaluation->avaluador->nom ?? '—' }} {{ $evaluation->avaluador->cognom ?? '' }}
                                    </p>
                                    @if($evaluation->observacions)
                                        <p class="text-gray-700 mt-2 whitespace-pre-line">
                                            {{ Str::limit($evaluation->observacions, 120) }}
                                        </p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>

        <!-- Cursos y projectes/comissions lado a lado -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            <!-- Projectes / Comissions -->
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">
                    Projectes / Comissions
                </h2>

                @php
                    // Combine projects and commissions
                    $entries = $profesional->projectesComissions()->with('profesional')->get();
                @endphp

                @if($entries->isEmpty())
                    <p class="text-gray-500 italic">
                        Aquest professional no està registrat a cap projecte ni comissió.
                    </p>
                @else
                    <ul class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                        @foreach($entries as $entry)
                            <li class="cursor-pointer p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-100 transition"
                                onclick="window.location='{{ route('projectes_comissions.show', $entry->id) }}'">
                                <div class="space-y-1">
                                    <div class="font-semibold text-orange-600 text-lg">
                                        {{ $entry->nom }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($entry->data_inici)->format('d/m/Y') }}
                                    </div>
                                    <div class="text-sm text-gray-700">
                                        <span class="font-semibold">Tipus:</span> {{ ucfirst($entry->tipus) }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Cursos / Trainings -->
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">Cursos</h2>

                @if($profesional->trainings->isEmpty())
                    <p class="text-gray-500 italic">El professional no està assignat a cap curs.</p>
                @else
                    <ul class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                        @foreach($profesional->trainings as $training)
                            <li class="cursor-pointer p-3 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-50 transition"
                                onclick="window.location='{{ route('training.show', $training->id) }}'">
                                <div class="flex flex-col space-y-1">
                                    <p class="font-medium text-orange-600">
                                        {{ $training->nom_curs }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Inici: {{ \Carbon\Carbon::parse($training->data_inici)->format('d/m/Y') }}
                                        | Fi: {{ \Carbon\Carbon::parse($training->data_fi)->format('d/m/Y') }}
                                    </p>
                                    @if($training->descripcio)
                                        <p class="text-gray-700 mt-2 whitespace-pre-line">
                                            {{ Str::limit($training->descripcio, 120) }}
                                        </p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <!-- Documentacio -->
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">
                    Documentació
                </h2>

                @if($profesional->documentacions->isEmpty())
                    <p class="text-gray-500 italic">
                        Encara no hi ha documentació registrada.
                    </p>
                @else
                    <ul class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                        @foreach($profesional->documentacions as $document)
                            <li class="p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-100 transition">
                                <div class="space-y-1">
                                    <div class="font-semibold text-orange-600 text-lg">
                                        {{ $document->nom }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($document->data)->format('d/m/Y') }}
                                    </div>

                                    <div class="text-sm text-gray-700">
                                        <span class="font-semibold">Fitxer:</span>
                                        <a
                                            href="{{ asset('storage/' . $document->fitxer) }}"
                                            target="_blank"
                                            class="text-blue-600 hover:underline"
                                        >
                                            Veure / Descarregar document
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>


            <!-- Accidentabilitat -->
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">Accidentabilitat</h2>

                @if($profesional->accidentabilitats->isEmpty())
                    <p class="text-gray-500 italic">Encara no hi ha accidents registrats.</p>
                @else
                    <ul class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                        @foreach($profesional->accidentabilitats as $accident)
                            <li class="cursor-pointer p-3 bg-gray-50 rounded-xl border border-gray-200 hover:bg-orange-50 transition"
                                onclick="window.location='{{ route('accidentabilitat.show', $accident->id) }}'">
                                <div class="flex flex-col space-y-1">
                                    <p class="font-medium text-orange-600">
                                        Accidentabilitat del {{ \Carbon\Carbon::parse($accident->data)->format('d/m/Y') }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Durada: {{ $accident->durada ?? '—' }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Tipus d'accident:
                                        <td class="px-6 py-4 text-gray-700">
                                            @if ($accident->tipus === 'sense_baixa')
                                                Sense Baixa
                                            @elseif ($accident->tipus === 'amb_baixa')
                                                Amb Baixa
                                            @else
                                {{ $accident->tipus }}
                            @endif
                        </td>
                                        
                                    </p>
                                    @if($accident->observacions)
                                        <p class="text-gray-700 mt-2 whitespace-pre-line">
                                            {{ Str::limit($accident->observacions, 120) }}
                                        </p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>

        <!-- Botones finales -->
        <div class="flex flex-wrap justify-between gap-4">
            <a href="{{ route('profesional.index') }}" 
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl shadow transition">
                Tornar al llistat
            </a>
            <a href="{{ route('profesional.edit', $profesional->id) }}" 
               class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl shadow transition">
                Editar Professional
            </a>
        </div>

    </div>
</div>
@endsection
