@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-8 text-orange-500 text-center">
        Agenda de Contactes Externs
    </h1>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($contacts as $contact)
            <div
                onclick="window.location='{{ route('external_contacts.show', $contact->id) }}'"
                class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 cursor-pointer hover:shadow-xl hover:-translate-y-1 transition">

                <!-- Estado -->
                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm font-semibold px-3 py-1 rounded-full
                        {{ $contact->actiu ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ $contact->actiu ? 'Actiu' : 'Inactiu' }}
                    </span>

                    <!-- Acciones -->
                    <div class="flex space-x-3" onclick="event.stopPropagation()">
                        <a href="{{ route('external_contacts.edit', $contact->id) }}"
                           class="text-orange-400 hover:text-orange-600"
                           title="Editar">
                            <svg class="h-5 w-5">
                                <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                            </svg>
                        </a>

                        <form action="{{ route('external_contacts.active', $contact) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    title="{{ $contact->actiu ? 'Desactivar' : 'Activar' }}">
                                <svg class="h-5 w-5
                                    {{ $contact->actiu ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}">
                                    <use href="{{ asset('icons/sprite.svg#' . ($contact->actiu ? 'icon-x' : 'icon-check')) }}"></use>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Responsable -->
                <h2 class="text-xl font-bold text-gray-800 mb-1">
                    {{ $contact->responsable ?? 'Sense responsable' }}
                </h2>

                <!-- Empresa -->
                <p class="text-gray-600 text-sm mb-2">
                    {{ $contact->empresa_departament ?? 'Sense empresa' }}
                </p>

                <!-- Tipo -->
                <p class="text-sm text-orange-500 font-semibold mb-4">
                    {{ $contact->tipus_servei ?? 'N/A' }}
                </p>

                <!-- Teléfono -->
                <div class="flex items-center justify-between mt-4">
                    <span class="text-lg font-mono text-gray-700">
                        📞 {{ $contact->telefon ?? 'N/A' }}
                    </span>

                    <span class="text-sm text-gray-400">
                        ID #{{ $contact->id }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-10 text-center">
        <a href="{{ route('menu') }}"
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
            Tornar al menú
        </a>
    </div>
</div>
@endsection
