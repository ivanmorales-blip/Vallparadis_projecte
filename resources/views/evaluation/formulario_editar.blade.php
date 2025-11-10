@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
            Editar Avaluació
        </h1>

        <form action="{{ route('evaluation.update', $evaluation) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Data -->
            <div>
                <label for="data" class="block text-sm font-medium text-gray-700 mb-1">Data *</label>
                <input type="date" id="data" name="data" required value="{{ $evaluation->data }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Cuestionario -->
            <div class="border rounded-xl overflow-hidden">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 text-center font-semibold">
                        <tr>
                            <th class="px-4 py-2 text-left">Aspecte</th>
                            <th>Gens d’acord</th>
                            <th>Poc d’acord</th>
                            <th>Bastant d’acord</th>
                            <th>Molt d’acord</th>
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

                        @foreach ($questions as $index => $text)
                            @php
                                $field = 'pregunta' . ($index + 1);
                                $selected = $evaluation->$field ?? null;
                            @endphp
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $text }}</td>
                                @for ($i = 1; $i <= 4; $i++)
                                    <td class="text-center">
                                        <input type="radio" 
                                            name="pregunta{{ $index + 1 }}" 
                                            value="{{ $i }}" 
                                            class="scale-110 accent-orange-500"
                                            {{ $selected == $i ? 'checked' : '' }}>
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Sumatori (automàtic) -->
            <div>
                <label for="sumatori" class="block text-sm font-medium text-gray-700 mb-1">Sumatori</label>
                <input type="number" id="sumatori" name="sumatori" readonly required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-100 text-gray-600"
                    value="{{ old('sumatori') }}">
                <p class="text-xs text-gray-500 mt-1">El valor es calcula automàticament segons les respostes.</p>
            </div>

            <!-- Observacions -->
            <div>
                <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                <textarea id="observacions" name="observacions" rows="3"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ $evaluation->observacions }}</textarea>
            </div>

            <!-- Arxiu -->
            <div>
                <label for="arxiu" class="block text-sm font-medium text-gray-700 mb-1">Arxiu</label>
                <input type="file" id="arxiu" name="arxiu"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Professional -->
            <div>
                <label for="id_profesional" class="block text-sm font-medium text-gray-700 mb-1">Professional *</label>
                <select id="id_profesional" name="id_profesional" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}" {{ $evaluation->id_profesional == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Professional Avaluador -->
            <div>
                <label for="id_profesional_avaluador" class="block text-sm font-medium text-gray-700 mb-1">Professional Avaluador *</label>
                <select id="id_profesional_avaluador" name="id_profesional_avaluador" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Selecciona un professional avaluador --</option>
                    @foreach ($professionals as $prof)
                        <option value="{{ $prof->id }}" {{ $evaluation->id_profesional_avaluador == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('menu') }}"
                   class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition shadow">
                    Cancel·lar
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
