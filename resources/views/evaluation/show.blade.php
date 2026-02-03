@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-3xl p-10 border border-gray-200">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
            <div>
                <h1 class="text-4xl font-extrabold text-orange-500">
                    {{ $evaluation->profesional->nom ?? '—' }} {{ $evaluation->profesional->cognom ?? '' }}
                </h1>
                <p class="text-gray-500 mt-1">Avaluació detallada</p>
            </div>
            <span class="mt-4 md:mt-0 px-5 py-2 rounded-full text-sm font-semibold 
                {{ $evaluation->profesional->estat ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $evaluation->profesional->estat ? 'Actiu' : 'Inactiu' }}
            </span>
        </div>

        <!-- Información general -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 text-gray-700">
            <div class="space-y-3">
                <div>
                    <span class="font-semibold">Data:</span>
                    <span>{{ $evaluation->data instanceof \Carbon\Carbon ? $evaluation->data->format('d/m/Y') : $evaluation->data }}</span>
                </div>
                <div>
                    <span class="font-semibold">Professional:</span>
                    <span>{{ $evaluation->profesional->nom ?? '—' }} {{ $evaluation->profesional->cognom ?? '' }}</span>
                </div>
                <div>
                    <span class="font-semibold">Avaluador:</span>
                    <span>{{ $evaluation->avaluador->nom ?? '—' }} {{ $evaluation->avaluador->cognom ?? '' }}</span>
                </div>
            </div>
            <div class="space-y-3">
                <div>
                    <span class="font-semibold">Mitjana:</span>
                    <span class="text-lg font-bold text-orange-500">{{ $evaluation->sumatori ?? '—' }}</span>
                </div>
                <div>
                    <span class="font-semibold">Arxiu:</span>
                    @if($evaluation->arxiu)
                        <a href="{{ asset('storage/' . $evaluation->arxiu) }}" target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl shadow transition">
                            Obrir arxiu
                        </a>
                    @else
                        <span>—</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Preguntas -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b border-gray-300 pb-2">Respostes del qüestionari</h2>
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-100 text-center font-semibold">
                        <tr>
                            <th class="px-4 py-2 text-left">Aspecte</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $questions = [
                                "Realitza una correcta atenció a l'usuari",
                                "Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa",
                                "S'ha integrat dins l'equip de treball i participa i coopera sense dificultats",
                                "Pot treballar amb altres equips diferents al seu si es necessita",
                                "Compleix amb les funcions establertes",
                                "Assoleix els objectius utilitzant els recursos disponibles per aconseguir els resultats esperats",
                                "És coherent amb el que diu i amb les seves actuacions",
                                "Les seves actuacions van alineades amb els valors de la nostra Entitat",
                                "Mostra capacitat i interès en entendre i aplicar la normativa i els procediments establerts",
                                "La seva actitud envers els seus responsables/comandaments és correcta",
                                "Té capacitat per a comprendre, acceptar i adequar-se als canvis",
                                "Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat o constant",
                                "Fa suggeriments i propostes de millora",
                                "Assoleix els objectius, esforçant-se per aconseguir el resultat esperat",
                                "La quantitat de treball que desenvolupa en relació amb el treball encomanat és adequada",
                                "Realitza les tasques amb la qualitat esperada i/o necessària",
                                "Expressa amb claredat i ordre els aspectes rellevants de la informació",
                                "Disposa dels coneixements necessaris per desenvolupar les tasques requerides del lloc de treball",
                                "Mostra interès i motivació envers el seu lloc de treball",
                                "La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades"
                            ];
                        @endphp
                        @foreach($questions as $index => $text)
                            @php
                                $field = 'pregunta'.($index+1);
                                $selected = (int) $evaluation->$field;
                            @endphp
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="px-4 py-2 text-left">{{ $text }}</td>
                                @for($i=1; $i<=4; $i++)
                                    <td class="text-center">
                                        @if($selected == $i)
                                            <span class="inline-block w-6 h-6 bg-green-500 text-white rounded-full font-bold leading-6">✔</span>
                                        @else
                                            <span class="inline-block w-6 h-6 text-gray-300">—</span>
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Observaciones -->
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-8">
            <h2 class="text-xl font-bold mb-2 text-gray-800">Observacions</h2>
            <p class="text-gray-700 whitespace-pre-line">{{ $evaluation->observacions ?? '—' }}</p>
        </div>

        <!-- Botones -->
        <div class="flex flex-wrap justify-start gap-4">
            <a href="{{ route('evaluation.index') }}"
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl shadow transition">
                ← Tornar
            </a>
        </div>

    </div>
</div>
@endsection
