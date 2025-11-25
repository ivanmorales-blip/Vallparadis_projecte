@extends('layouts.template')

@section('contingut')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-8">

        <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
            {{ $type == 'pendent' ? 'Editar Tema Pendent' : 'Editar Seguiment' }}
        </h1>

        <form action="{{ route('rrhh.update', [$centre_id, $type, $item->id]) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-5">
            
            @csrf
            @method('PATCH')

            {{-- ===================================== --}}
            {{--             TEMA PENDENT             --}}
            {{-- ===================================== --}}
            @if ($type == 'pendent')

                <!-- Data obertura -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Data Obertura *</label>
                    <input type="date" name="data_obertura" value="{{ $item->data_obertura }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 
                               focus:outline-none focus:ring-2 focus:ring-orange-400">
                </div>

                <!-- Professional afectat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Professional afectat *</label>
                    <input type="text" name="professional_afectat" value="{{ $item->professional_afectat }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 
                               focus:outline-none focus:ring-2 focus:ring-orange-400">
                </div>

                <!-- Descripció -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripció *</label>
                    <textarea name="descripcio" rows="3" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 
                               focus:outline-none focus:ring-2 focus:ring-orange-400">{{ $item->descripcio }}</textarea>
                </div>

                <!-- Professional que registra -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Professional que registra *</label>
                    <input type="text" name="professional_registra" value="{{ $item->professional_registra }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 
                               focus:outline-none focus:ring-2 focus:ring-orange-400">
                </div>

                <!-- A qui es derivat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">A qui es derivat</label>
                    <input type="text" name="derivat_a" value="{{ $item->derivat_a }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 
                               focus:outline-none focus:ring-2 focus:ring-orange-400">
                </div>

            @else

            {{-- ===================================== --}}
            {{--              SEGUIMENT                --}}
            {{-- ===================================== --}}

                <!-- Data -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Data *</label>
                    <input type="date" name="data" value="{{ $item->data }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 
                               focus:outline-none focus:ring-2 focus:ring-orange-400">
                </div>

                <!-- Professional -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Professional *</label>
                    <input type="text" name="professional" value="{{ $item->professional }}" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 
                               focus:outline-none focus:ring-2 focus:ring-orange-400">
                </div>

                <!-- Descripció -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripció *</label>
                    <textarea name="descripcio" rows="3" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 
                               focus:outline-none focus:ring-2 focus:ring-orange-400">{{ $item->descripcio }}</textarea>
                </div>

            @endif

            <!-- Document adjunt -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Document adjunt</label>
                
                @if($item->document)
                    <p class="text-sm text-blue-600 underline mb-1">
                        Document actual: <a href="{{ asset('uploads/'.$item->document) }}" target="_blank">Veure arxiu</a>
                    </p>
                @endif

                <input type="file" name="document"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2">
            </div>

            <!-- Botons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('rrhh.show', $centre_id) }}"
                   class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition shadow">
                    Cancel·lar
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow transition">
                    Actualitzar
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
