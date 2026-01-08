@extends('layouts.template')

@section('contingut')
<div class="p-8 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">
        Llistat de Contactes Externs
    </h1>

    <div class="flex justify-center">
        <div class="w-full max-w-6xl"></div>
    </div>

    <div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-lg rounded-xl border border-gray-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">#</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Tipus de Servei</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Empresa/Departament</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Responsable</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Telèfon</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Estat</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase text-sm">Accions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach($contacts as $contact)
                        <tr id="row-{{ $contact->id }}" 
                            class="hover:bg-orange-50 transition duration-200 cursor-pointer"
                            onclick="window.location='{{ route('external_contacts.show', $contact->id) }}'">

                            <!-- ID -->
                            <td class="px-6 py-4 text-gray-600 font-medium">{{ $contact->id }}</td>

                            <!-- Tipus de contacte -->
                            <td class="px-6 py-4 text-gray-700">{{ $contact->tipus_servei ?? 'N/A' }}</td>

                            <!-- Empresa / Departament -->
                            <td class="px-6 py-4 text-gray-700">{{ $contact->empresa_departament ?? 'N/A' }}</td>

                            <!-- Responsable -->
                            <td class="px-6 py-4 text-gray-700">{{ $contact->responsable ?? 'N/A' }}</td>

                            <!-- Telèfon -->
                            <td class="px-6 py-4 text-gray-700">{{ $contact->telefon ?? 'N/A' }}</td>

                            <!-- Estat -->
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full font-semibold text-sm 
                                    {{ $contact->actiu ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ $contact->actiu ? 'Actiu' : 'Inactiu' }}
                                </span>
                            </td>

                            <!-- Acciones -->
                            <td class="px-6 py-4 flex space-x-3" onclick="event.stopPropagation()">
                                
                                <!-- Editar -->
                                <a href="{{ route('external_contacts.edit', $contact->id) }}" 
                                   class="text-orange-400 hover:text-orange-500 transition" 
                                   title="Editar">
                                    <svg class="h-6 w-6" aria-label="Editar">
                                        <use href="{{ asset('icons/sprite.svg#icon-edit') }}"></use>
                                    </svg>
                                </a>

                                <!-- Activar / Desactivar -->
                                <form action="{{ route('external_contacts.active', $contact) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="activar-desactivar text-sm transition"
                                            title="{{ $contact->actiu ? 'Desactivar' : 'Activar' }}">
                                        <svg class="h-6 w-6 {{ $contact->actiu ? 'text-red-400 hover:text-red-500' : 'text-green-400 hover:text-green-500' }}"
                                            aria-label="{{ $contact->actiu ? 'Desactivar' : 'Activar' }}">
                                            <use href="{{ asset('icons/sprite.svg#' . ($contact->actiu ? 'icon-x' : 'icon-check')) }}"></use>
                                        </svg>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('menu') }}"
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg transition">
            Tornar al menú
        </a>
    </div>    
</div>
@endsection
