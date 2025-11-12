@extends('layouts.template')

@section('contingut')
<div class="w-full max-w-4xl bg-white shadow-lg rounded-2xl p-8 mx-auto mt-10">
    <h1 class="text-3xl font-bold text-orange-500 mb-8 text-center">
        Afegir Avaluació
    </h1>

    <form action="{{ route('evaluation.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Data -->
        <div>
            <label for="data" class="block text-sm font-medium text-gray-700 mb-2">Data *</label>
            <input type="date" id="data" name="data" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                value="{{ old('data') }}">
        </div>

        <!-- QÜESTIONARI DE VALORACIÓ -->
<div>
    <h2 class="text-lg font-semibold text-gray-800 mb-2 mt-4">Qüestionari de Valoració del Professional</h2>
    <div class="overflow-x-auto border rounded-xl">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2 text-left">Aspecte</th>
                    <th class="text-center px-2 py-2">1<br><span class="text-xs text-gray-500">Gens d'acord</span></th>
                    <th class="text-center px-2 py-2">2<br><span class="text-xs text-gray-500">Poc d'acord</span></th>
                    <th class="text-center px-2 py-2">3<br><span class="text-xs text-gray-500">Bastant d'acord</span></th>
                    <th class="text-center px-2 py-2">4<br><span class="text-xs text-gray-500">Molt d'acord</span></th>
                </tr>
            </thead>
            <tbody id="questionsBody"></tbody>
        </table>
    </div>
</div>


        <!-- Sumatori -->
        <div>
            <label for="sumatori" class="block text-sm font-medium text-gray-700 mb-1">Sumatori </label>
            <input type="number" id="sumatori" name="sumatori" required step="0.01" min="0"
            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
            value="{{ old('sumatori') }}">

        </div>
    </div>

        <!-- Sumatori (automàtic) -->
    <div>
        <label for="sumatori" class="block text-sm font-medium text-gray-700 mb-1">Sumatori</label>
        <input type="number" id="sumatori" name="sumatori" readonly required
            class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-100 text-gray-600"
            value="{{ old('sumatori') }}">
    </div>

        <!-- Observacions -->
        <div>
            <label for="observacions" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
            <textarea id="observacions" name="observacions"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('observacions') }}</textarea>
        </div>

        <!-- Arxiu -->
        <div>
            <label for="arxiu" class="block text-sm font-medium text-gray-700 mb-1">Arxiu</label>
            <input type="file" id="arxiu" name="arxiu"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
        </div>

        <!-- Professional -->
        <div>
            <label for="profesional_id" class="block text-sm font-medium text-gray-700 mb-1">Professional </label>
            <select id="profesional_id" name="id_profesional" required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="">Selecciona un professional</option>
                @foreach($professionals as $prof)
                    <option value="{{ $prof->id }}"
                        {{ ($selectedProfesional == $prof->id || old('id_profesional') == $prof->id) ? 'selected' : '' }}>
                        {{ $prof->nom }} {{ $prof->cognom }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Professional Avaluador -->
        <div>
            <label for="profesional_avaluador_id" class="block text-sm font-medium text-gray-700 mb-2">Avaluador</label>
            <select id="profesional_avaluador_id" name="id_profesional_avaluador"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="">Selecciona un professional avaluador</option>
                @foreach($professionals as $prof)
                    <option value="{{ $prof->id }}" {{ old('id_profesional_avaluador') == $prof->id ? 'selected' : '' }}>
                        {{ $prof->nom }} {{ $prof->cognom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Preguntas -->
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Avaluació del professional</h2>
            <div class="overflow-x-auto border rounded-xl">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 text-left">Aspecte</th>
                            <th class="text-center px-2 py-2">Gens d'acord</th>
                            <th class="text-center px-2 py-2">Poc d'acord</th>
                            <th class="text-center px-2 py-2">Bastant d'acord</th>
                            <th class="text-center px-2 py-2">Molt d'acord</th>
                        </tr>
                    </thead>
                    <tbody id="questionsBody"></tbody>
                </table>
            </div>
        </div>

        <!-- Sumatori (automàtic) -->
        <div>
            <label for="sumatori" class="block text-sm font-medium text-gray-700 mb-2">Mitjana</label>
            <input type="number" id="sumatori" name="sumatori" readonly required
                class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-100 text-gray-600"
                value="{{ old('sumatori') }}">
        </div>

        <!-- Observacions -->
        <div>
            <label for="observacions" class="block text-sm font-medium text-gray-700 mb-2">Observacions</label>
            <textarea id="observacions" name="observacions"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('observacions') }}</textarea>
        </div>

        <!-- Arxiu -->
        <div>
            <label for="arxiu" class="block text-sm font-medium text-gray-700 mb-2">Arxiu</label>
            <input type="file" id="arxiu" name="arxiu"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
        </div>

        <!-- Botón enviar -->
        <div class="text-center">
            <button type="submit"
                class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-lg transition">
                Guardar Avaluació
            </button>
        </div>
    </form>
</div>
<<<<<<< HEAD

<!-- SCRIPT PARA PREGUNTAS Y SUMATORI -->
=======
@endsection
>>>>>>> 747527e (Guardar cambios)
<script>
document.addEventListener("DOMContentLoaded", () => {
  const QUESTIONS = [
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

  const tbody = document.getElementById("questionsBody");
  const sumInput = document.getElementById("sumatori");

<<<<<<< HEAD
    QUESTIONS.forEach((q, i) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td class="px-3 py-2">${q}</td>
            ${[1,2,3,4].map(v => `
                <td class='text-center'>
                    <input type='radio' name='pregunta${i + 1}' value='${v}' class='scale-110 accent-orange-500'>
                </td>
            `).join('')}
        `;
        tbody.appendChild(tr);
    });
=======
  QUESTIONS.forEach((q, i) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td class="px-3 py-2">${q}</td>
      ${[1,2,3,4].map(v => `
        <td class='text-center'>
          <input type='radio' name='q${i}' value='${v}' class='scale-110 accent-orange-500'>
        </td>
      `).join('')}
    `;
    tbody.appendChild(tr);
  });

  document.querySelectorAll("input[type=radio]").forEach(radio => {
    radio.addEventListener("change", calcSumatori);
  });
>>>>>>> 747527e (Guardar cambios)

  function calcSumatori() {
    const radios = document.querySelectorAll("input[type=radio]:checked");
    let total = 0;
    radios.forEach(r => total += parseInt(r.value));
    const avg = radios.length ? (total / radios.length) : 0;
    sumInput.value = avg.toFixed(2);
  }
});
</script>
<<<<<<< HEAD
@endsection
=======
>>>>>>> 747527e (Guardar cambios)
