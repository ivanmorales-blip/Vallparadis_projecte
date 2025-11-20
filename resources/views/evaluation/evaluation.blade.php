@extends('layouts.template')

@section('contingut')
@php
    $lockSelect = $lockSelect ?? false;
    $selectedProfesional = $selectedProfesional ?? null;
@endphp

<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-3xl p-10 border border-gray-200">

        <h1 class="text-4xl font-extrabold text-orange-500 text-center mb-8">
            {{ isset($evaluation) ? 'Editar Avaluació' : 'Afegir Avaluació' }}
        </h1>

        <form action="{{ isset($evaluation) ? route('evaluation.update', $evaluation->id) : route('evaluation.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if(isset($evaluation))
                @method('PUT')
            @endif

            <!-- Fecha -->
            <div>
                <label for="data" class="block text-sm font-medium text-gray-700 mb-2">Data *</label>
                <input type="date" id="data" name="data" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                    value="{{ old('data', isset($evaluation) ? $evaluation->data->format('Y-m-d') : '') }}">
            </div>

            <!-- Professional -->
            <div>
                <label for="profesional_id" class="block text-sm font-medium text-gray-700 mb-2">Professional *</label>

                <select id="profesional_id"
                    name="id_profesional"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                    @if($lockSelect) disabled @endif>
                    <option value="">Selecciona un professional</option>
                    @foreach($professionals as $prof)
                        <option value="{{ $prof->id }}"
                            {{ (old('id_profesional', $selectedProfesional ?? (isset($evaluation) ? $evaluation->id_profesional : null)) == $prof->id) ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>

                {{-- si está bloqueado, enviamos el valor real con hidden --}}
                @if($lockSelect)
                    <input type="hidden" name="id_profesional" value="{{ $selectedProfesional }}">
                    {{-- si venimos desde la ficha de un profesional, guardamos la info para redirigir luego --}}
                    <input type="hidden" name="return_to_profesional" value="{{ $selectedProfesional }}">
                @endif
            </div>

            <!-- Avaluador -->
            <div>
                <label for="profesional_avaluador_id" class="block text-sm font-medium text-gray-700 mb-2">Avaluador</label>
                <select id="profesional_avaluador_id" name="id_profesional_avaluador"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="">Selecciona un professional avaluador</option>
                    @foreach($professionals as $prof)
                        <option value="{{ $prof->id }}"
                            {{ old('id_profesional_avaluador', isset($evaluation) ? $evaluation->id_profesional_avaluador : '') == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nom }} {{ $prof->cognom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Preguntas -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4 mt-4">Qüestionari de Valoració</h2>
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
                        <tbody id="questionsBody"></tbody>
                    </table>
                </div>
            </div>

            <!-- Sumatori -->
            <div class="flex justify-between items-center mt-4">
                <label for="sumatori" class="block text-sm font-medium text-gray-700">Mitjana</label>
                <span id="sumDisplay" class="px-4 py-2 bg-orange-100 text-orange-800 rounded-xl font-bold text-lg">
                    {{ old('sumatori') ?? '0.00' }}
                </span>
                <input type="hidden" id="sumatori" name="sumatori" value="{{ old('sumatori') ?? 0 }}">
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

            <div class="text-center">
                <button type="submit"
                    class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl shadow-lg transition">
                    Guardar Avaluació
                </button>
            </div>
        </form>
    </div>

       
    </form>
</div>

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
        "Expressa amb claredat y ordre els aspectes rellevants",
        "Disposa dels coneixements necessaris per desenvolupar les tasques",
        "Mostra interès i motivació envers el seu lloc de treball",
        "La seva entrada i permanència es duu sense retards"
    ];

    const oldValues = @json($oldValues ?? []) || {};
    const tbody = document.getElementById("questionsBody");
    const sumInput = document.getElementById("sumatori");
    const sumDisplay = document.getElementById("sumDisplay");

    QUESTIONS.forEach((q, i) => {
        const field = 'pregunta' + (i+1);
        const selectedValue = oldValues[field] || 0;

        const tr = document.createElement("tr");
        tr.classList.add(i % 2 === 0 ? 'bg-gray-50' : 'bg-white');

        tr.innerHTML = `
            <td class="px-4 py-2">${q}</td>
            ${[1,2,3,4].map(v => `
                <td class="text-center">
                    <button type="button"
                        class="btn-toggle px-4 py-2 rounded-full transition border border-gray-300 ${selectedValue == v ? 'bg-orange-500 text-white shadow-lg' : 'bg-white text-gray-700'}"
                        data-field="${field}" data-value="${v}">
                        ${v}
                    </button>
                </td>`).join('')}
        `;

        tbody.appendChild(tr);
    });

    tbody.addEventListener("click", e => {
        if (e.target.classList.contains('btn-toggle')) {
            const field = e.target.dataset.field;
            const value = e.target.dataset.value;

            tbody.querySelectorAll(`button[data-field="${field}"]`).forEach(btn => {
                btn.classList.remove('bg-orange-500','text-white','shadow-lg');
                btn.classList.add('bg-white','text-gray-700');
            });

            e.target.classList.add('bg-orange-500','text-white','shadow-lg');
            e.target.classList.remove('bg-white','text-gray-700');

            let input = document.querySelector(`input[name="${field}"]`);
            if (!input) {
                input = document.createElement("input");
                input.type = "hidden";
                input.name = field;
                tbody.appendChild(input);
            }
            input.value = value;

            updateSumatori();
        }
    });

    function updateSumatori() {
        let total = 0, count = 0;
        tbody.querySelectorAll('input[type=hidden]').forEach(i => {
            total += parseInt(i.value);
            count++;
        });

        const avg = count ? total / count : 0;
        sumInput.value = avg.toFixed(2);
        sumDisplay.textContent = avg.toFixed(2);
    }
});
</script>

<style>
.btn-toggle:hover {
    cursor: pointer;
    transform: scale(1.05);
}
</style>
@endsection
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

  function calcSumatori() {
    const radios = document.querySelectorAll("input[type=radio]:checked");
    let total = 0;
    radios.forEach(r => total += parseInt(r.value));
    const avg = radios.length ? (total / radios.length) : 0;
    sumInput.value = avg.toFixed(2);
  }
});
</script>
