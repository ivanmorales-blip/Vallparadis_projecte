@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-3xl p-10 border border-gray-200">

        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
            Editar Avaluació
        </h1>

        <form action="{{ route('evaluation.update', $evaluation->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Data -->
            <div>
                <label for="data" class="block text-sm font-medium text-gray-700 mb-2">Data *</label>
                <input type="date" id="data" name="data" required
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                       value="{{ old('data', $evaluation->data->format('Y-m-d')) }}">
            </div>

            <!-- Professional -->
            <div>
                <label for="profesional_id" class="block text-sm font-medium text-gray-700 mb-2">Professional *</label>
                <select id="profesional_id" name="id_profesional" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">Selecciona un professional</option>
                    @foreach($professionals as $prof)
                        <option value="{{ $prof->id }}"
                                {{ (old('id_profesional', $evaluation->id_profesional) == $prof->id) ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Avaluador -->
            <div>
                <label for="profesional_avaluador_id" class="block text-sm font-medium text-gray-700 mb-2">Avaluador *</label>
                <select id="profesional_avaluador_id" name="id_profesional_avaluador" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">Selecciona un avaluador</option>
                    @foreach($professionals as $prof)
                        <option value="{{ $prof->id }}"
                                {{ (old('id_profesional_avaluador', $evaluation->id_profesional_avaluador) == $prof->id) ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Preguntas -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-2 mt-4">Qüestionari</h2>
                <div class="overflow-x-auto border rounded-xl">
                    <table class="min-w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 text-center">
                            <tr>
                                <th class="px-3 py-2 text-left">Aspecte</th>
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
                                "Disposa dels coneixements necessaris per a desenvolupar les tasques requerides del lloc de treball",
                                "Mostra interès i motivació envers el seu lloc de treball",
                                "La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades"
                            ];
                        @endphp
                        @foreach($questions as $index => $text)
                            @php $field = 'pregunta'.($index+1); @endphp
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="px-3 py-2">{{ $text }}</td>
                                @for($i=1; $i<=4; $i++)
                                    <td class="text-center">
                                        <input type="radio" name="{{ $field }}" value="{{ $i }}"
                                            {{ old($field, $evaluation->{'q'.$index}) == $i ? 'checked' : '' }}
                                            class="accent-orange-500">
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Sumatori -->
            <div>
                <label for="sumatori" class="block text-sm font-medium text-gray-700 mb-1">Mitjana</label>
                <input type="number" id="sumatori" name="sumatori" step="0.01" required
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                       value="{{ old('sumatori', $evaluation->sumatori) }}">
            </div>

            <!-- Observacions -->
            <div>
                <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                <textarea id="observacions" name="observacions"
                          class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('observacions', $evaluation->observacions) }}</textarea>
            </div>

            <!-- Arxiu -->
            <div>
                <label for="arxiu" class="block text-sm font-medium text-gray-700 mb-1">Arxiu</label>
                <input type="file" id="arxiu" name="arxiu"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                @if($evaluation->arxiu)
                    <p class="mt-2 text-sm text-gray-600">
                        Fitxer actual: <a href="{{ asset('storage/' . $evaluation->arxiu) }}" target="_blank" class="text-blue-600 underline">Veure</a>
                    </p>
                @endif
            </div>

            <!-- Botón enviar -->
            <div class="text-center">
                <button type="submit"
                        class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-lg transition">
                    Actualitzar Avaluació
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
