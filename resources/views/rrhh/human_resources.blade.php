@extends('layouts.template')

@section('contingut')
@php $type = $type ?? 'pendent'; @endphp

<div class="w-full max-w-4xl bg-white shadow-lg rounded-2xl p-8 mx-auto mt-10">
    <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
        Afegir Registre - Centre {{ $centre_id }}
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data" class="space-y-5"
          action="{{ route('human_resources.store', [$centre_id, $type]) }}">
        @csrf

        <!-- Tipo -->
        <div>
            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipus </label>
            <select id="type" name="tipus" required class="w-full border px-4 py-2 rounded-xl">
                <option value="pendent" {{ $type=='pendent' ? 'selected' : '' }}>Tema Pendent</option>
                <option value="seguiment" {{ $type=='seguiment' ? 'selected' : '' }}>Seguiment</option>
            </select>
        </div>

        <!-- Campos Tema Pendent -->
        <div id="pendent-fields" style="{{ $type=='pendent' ? '' : 'display:none;' }}">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data Obertura</label>
                <input type="date" name="data_obertura" value="{{ old('data_obertura') }}" required class="w-full border px-4 py-2 rounded-xl">
            </div>

            <!--Professional Afectat-->
            <div>
            <label for="professiona_afectat" class="block text-sm font-medium text-gray-700 mb-1">Professional Afectat</label>
            <select name="professional_afectat" class="w-full border px-4 py-2 rounded-xl">
                <option value="">-- Selecciona --</option>
                @foreach(App\Models\Profesional::all() as $prof)
                    <option value="{{ $prof->id }}" {{ old('professional_afectat')==$prof->id ? 'selected' : '' }}>{{ $prof->nom }}</option>
                @endforeach
            </select>
        </div>

            <div>
                <label for="id_registre" class="block text-sm font-medium text-gray-700 mb-1">Registre</label>
                <select name="id_registre" class="w-full border px-4 py-2 rounded-xl">
                    @foreach(App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" {{ old('id_registre')==$user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="professiona_afectat" class="block text-sm font-medium text-gray-700 mb-1">Registre</label>
                <select name="id_registre" class="w-full border px-4 py-2 rounded-xl">
                    <option value="">-- Selecciona --</option>
                    @foreach(App\Models\Profesional::all() as $prof)
                        <option value="{{ $prof->id }}" {{ old('id_derivat')==$prof->id ? 'selected' : '' }}>{{ $prof->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Campos Seguiment -->
        <div id="seguiment-fields" style="{{ $type=='seguiment' ? '' : 'display:none;' }}">
            <div>
                <label class="block text-sm font-medium">Data *</label>
                <input type="date" name="data" value="{{ old('data') }}" required class="w-full border px-4 py-2 rounded-xl">
            </div>

            <div>
                <label class="block text-sm font-medium">Professional *</label>
                <select name="id_professional" required class="w-full border px-4 py-2 rounded-xl">
                    @foreach(App\Models\Profesional::all() as $prof)
                        <option value="{{ $prof->id }}" {{ old('id_professional')==$prof->id ? 'selected' : '' }}>{{ $prof->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Campos comunes -->
        <div>
            <label class="block text-sm font-medium">Descripció</label>
            <textarea name="descripcio" rows="3" class="w-full border px-4 py-2 rounded-xl">{{ old('descripcio') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium">Document</label>
            <input type="file" name="document" class="w-full">
        </div>

        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">
            Guardar
        </button>
    </form>
</div>

<script>
    const tipoSelect = document.getElementById('type');
    const pendentFields = document.getElementById('pendent-fields');
    const seguimentFields = document.getElementById('seguiment-fields');
    const form = document.querySelector('form');

    // Cambiar visibilidad de campos y form action al cambiar tipo
    tipoSelect.addEventListener('change', function() {
        if (this.value === 'pendent') {
            pendentFields.style.display = 'block';
            seguimentFields.style.display = 'none';
        } else {
            pendentFields.style.display = 'none';
            seguimentFields.style.display = 'block';
        }

        form.action = `/human_resources/store/{{ $centre_id }}/` + this.value;
    });
</script>
@endsection
