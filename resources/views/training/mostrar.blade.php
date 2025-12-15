@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gradient-to-b from-gray-50 via-white to-gray-100 py-14 px-6">

    <div class="max-w-4xl mx-auto relative">

        <!-- Glows decoratius -->
        <div class="absolute -top-16 -left-10 w-72 h-72 bg-orange-400/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-16 -right-10 w-72 h-72 bg-indigo-400/20 rounded-full blur-3xl"></div>

        <!-- Targeta principal -->
        <div class="relative bg-white/80 backdrop-blur-xl border border-white/40 shadow-2xl
                    rounded-3xl px-10 py-12 ring-1 ring-gray-200/50">

            <!-- TÍTOL + ESTAT -->
            <div class="flex justify-between items-start mb-12">

                <div>
                    <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight">
                        {{ $training->nom_curs }}
                    </h1>
                    <p class="text-gray-500 text-lg mt-2">Detall de la formació</p>
                </div>

                <div>
                    @if ($training->estat)
                        <span class="px-5 py-2 bg-green-100 text-green-700 font-semibold rounded-full 
                                     shadow-inner text-sm">
                            Actiu
                        </span>
                    @else
                        <span class="px-5 py-2 bg-red-100 text-red-700 font-semibold rounded-full 
                                     shadow-inner text-sm">
                            Inactiu
                        </span>
                    @endif
                </div>
            </div>

            <!-- GRID PRINCIPAL -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                <!-- Card esquerra -->
                <div class="p-6 bg-gray-50/70 border border-gray-200 rounded-2xl shadow-inner
                            hover:shadow-xl transition-all duration-300">

                    <p class="text-gray-900 font-semibold text-lg">Data d'inici</p>
                    <p class="text-gray-700 mb-5">
                        {{ \Carbon\Carbon::parse($training->data_inici)->format('d/m/Y') }}
                    </p>

                    <p class="text-gray-900 font-semibold text-lg">Data de finalització</p>
                    <p class="text-gray-700 mb-5">
                        {{ \Carbon\Carbon::parse($training->data_fi)->format('d/m/Y') }}
                    </p>

                    <p class="text-gray-900 font-semibold text-lg">Hores totals</p>
                    <p class="text-gray-700">
                        {{ $training->hores }} hores
                    </p>
                </div>

                <!-- Card dreta -->
                <div class="p-6 bg-gray-50/70 border border-gray-200 rounded-2xl shadow-inner
                            hover:shadow-xl transition-all duration-300">

                    <p class="text-gray-900 font-semibold text-lg">Centre</p>
                    <p class="text-gray-700 mb-5">
                        {{ $training->center->nom ?? '—' }}
                    </p>

                    <p class="text-gray-900 font-semibold text-lg">Objectiu</p>
                    <p class="text-gray-700 mb-5">
                        {{ $training->objectiu ?? '—' }}
                    </p>

                    <p class="text-gray-900 font-semibold text-lg">Formador</p>
                    <p class="text-gray-700">
                        {{ $training->formador }}
                    </p>
                </div>
            </div>

            <!-- Separador -->
            <div class="my-12 border-t border-gray-200"></div>

            <!-- PROFESSIONALS -->
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                Professionals assignats
            </h2>

            @if ($training->professionals->isEmpty())
                <p class="text-gray-500 italic">No hi ha professionals assignats a aquesta formació.</p>
            @else
                <ul class="space-y-3 max-h-96 overflow-y-auto pr-2
                           scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">

                    @foreach ($training->professionals as $prof)
                        <li class="p-4 bg-white/90 border border-gray-200 rounded-2xl shadow-md
                                   hover:shadow-xl transition-all duration-300">

                            <p class="font-semibold text-gray-900">
                                {{ $prof->nom }} {{ $prof->cognom }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $prof->email }}
                            </p>
                        </li>
                    @endforeach

                </ul>
            @endif

            <!-- BOTONS -->
            <div class="flex flex-wrap justify-between gap-5 mt-12">

                <a href="{{ route('trainings.index') }}"
                   class="px-7 py-3.5 text-gray-700 bg-white border border-gray-300 rounded-2xl
                          shadow hover:shadow-xl hover:bg-gray-100 transition-all
                          hover:-translate-y-0.5 hover:scale-[1.03] font-medium">
                    Tornar al llistat
                </a>

                <a href="{{ route('trainings.afegir_professionals', $training->id) }}"
                   class="px-7 py-3.5 bg-gradient-to-r from-orange-400 to-orange-500 text-white
                          rounded-2xl shadow-lg hover:shadow-xl transition-all font-semibold
                          hover:-translate-y-0.5 hover:scale-[1.04]">
                    Gestionar professionals
                </a>

                <a href="{{ route('trainings.edit', $training->id) }}"
                   class="px-7 py-3.5 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white
                          rounded-2xl shadow-lg hover:shadow-xl transition-all font-medium
                          hover:-translate-y-0.5 hover:scale-[1.04]">
                    Editar curs
                </a>

            </div>

        </div>
    </div>
</div>
@endsection
