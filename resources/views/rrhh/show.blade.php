@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 relative">

        <div class="flex justify-between items-start mb-6">
            <h1 class="text-3xl font-bold mb-8 text-orange-500">
            Seguiment {{ $tema->profesional->nom ?? '' }} {{ $tema->profesional->cognom ?? '' }}
        </h1>
        

            <!-- Etiqueta SEGUIMENT -->
        <div class="ml-4 flex items-center">
                <span class="bg-purple-100 text-purple-800 px-5 py-2 rounded-full font-semibold text-sm shadow-lg animate-pulse">
                    Segiment
                </span>
            </div>
        </div>

 <!-- Dades del seguiment -->
        <div class="grid grid-cols-2 gap-8 mt-6">

            <!-- Data -->
            <div>
                <h3 class="font-semibold text-gray-700">📅 Data:</h3>
                <p class="text-gray-600">
                    {{ \Carbon\Carbon::parse($tema->data_obertura)->format('d/m/Y') }}
                </p>
            </div>

            <!-- Professional -->
            <div>
                <h3 class="font-semibold text-gray-700"> Professional:</h3>
                <p class="text-gray-600">
                    {{ $tema->profesional->nom ?? 'N/A' }} {{ $tema->profesional->cognom ?? '' }}
                </p>
            </div>

            <!-- Descripció -->
            <div class="col-span-2">
                <h3 class="font-semibold text-gray-700"> Descripció:</h3>
                <p class="text-gray-600">{{ $tema->descripcio }}</p>
            </div>

            <!-- Documents -->
            <div class="col-span-2">
                <h3 class="font-semibold text-gray-700">Documents adjunts:</h3>

                @if($tema->document)
                    <a href="{{ route('temes.download', $tema->id) }}" 
                    class="text-blue-500 underline">
                        Descarregar document
                    </a>
                @else
                    <p class="text-gray-600">No hi ha documents adjunts</p>
                @endif
            </div>


        </div>

        <!-- Botons -->
        <div class="mt-10 flex justify-between">
            
        <a href="{{ route('menu') }}"
            class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-2xl shadow transition text-center">
            Tornar
        </a>
            <a href="{{ route('human_resources.edit', $tema->id) }}"
               class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-lg shadow">
                Editar
            </a>
        </div>

    </div>





</div>        

       

</div>
@endsection
