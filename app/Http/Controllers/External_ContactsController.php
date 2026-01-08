<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\External_contacts;

class External_ContactsController extends Controller
{
    // Listar todos los contactos
    public function index()
    {
        $contacts = External_contacts::all();
        return view('external_contacts.listar', compact('contacts'));
    }

    // Mostrar formulario de creación de contacto (centro opcional)
    public function create($centre_id = null)
    {
        return view('external_contacts.formulario_alta', compact('centre_id'));
    }

    // Guardar un nuevo contacto
    public function store(Request $request)
    {
        $request->validate([
            'tipus_servei' => 'required|string|max:255',
            'empresa_departament' => 'nullable|string|max:255',
            'responsable' => 'nullable|string|max:255',
            'telefon' => 'nullable|string|max:50',
            'correu' => 'nullable|email|max:255',
            'observacions' => 'nullable|string',
            'centre_id' => 'required|integer',
        ]);

        External_contacts::create([
        'tipus_servei' => $request->tipus_servei,        
        'empresa_departament' => $request->empresa_departament,
        'responsable' => $request->responsable,
        'telefon' => $request->telefon,
        'correu' => $request->correu,
        'observacions' => $request->observacions,
        'centre_id' => $request->centre_id,
    ]);

    return redirect()->route('external_contacts.index')->with('success', 'Contacte creat correctament.');

    
}

public function update(Request $request, $id)
{
    $contact = External_contacts::findOrFail($id);

    $request->validate([
        'tipus_servei' => 'required|string|max:255',
        'empresa_departament' => 'nullable|string|max:255',
        'responsable' => 'nullable|string|max:255',
        'telefon' => 'nullable|string|max:50',
        'correu' => 'nullable|email|max:255',
        'observacions' => 'nullable|string',
    ]);

    $contact->update($request->all());

    return redirect()->route('external_contacts.index')
                     ->with('success', 'Contacte actualitzat correctament.');
}

public function show($id)
    {
        $contact = External_contacts::with([])->findOrFail($id);
        return view('external_contacts.show', compact('contact'));
    }

    public function edit($id)
{
    $contact = External_contacts::findOrFail($id);
    return view('external_contacts.formulario_editar', compact('contact'));
}

public function active($id)
{
    $contact = External_contacts::findOrFail($id);

    $contact->actiu = ! $contact->actiu;
    $contact->save();

    return redirect()
        ->route('external_contacts.index')
        ->with('success', 'Estat del contacte actualitzat correctament.');
}



}
