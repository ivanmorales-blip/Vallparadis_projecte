<?php

namespace App\Http\Controllers;

use App\Models\General_services;
use App\Models\Center;
use Illuminate\Http\Request;

class General_servicesController extends Controller
{
    /**
     * Listar servicios generales.
     */
    public function index()
    {
        $services = General_services::with('center')->get();
        return view('serveis_generals.lista', compact('services'));
    }

    /**
     * Mostrar formulario de alta.
     */
    public function create()
    {
        $centers = Center::all(); // tabla singular
        return view('serveis_generals.alta', compact('centers'));
    }

    /**
     * Guardar un servicio general.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipus' => 'required|string|max:255',
            'contacte' => 'required|string|max:255',
            'encarregat' => 'required|string|max:255',
            'id_center' => 'required|exists:center,id', // tabla singular
            'observacions' => 'nullable|string',
        ]);

        General_services::create($request->all());

        return redirect()->route('serveis_generals.index')
                         ->with('success', 'Servicio general añadido correctamente.');
    }

    /**
     * Mostrar un servicio específico.
     */
    public function show(General_services $general_service)
    {
        return view('serveis_generals.show', compact('general_service'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(General_services $general_service)
    {
        $centers = Center::all();
        return view('serveis_generals.alta', compact('general_service', 'centers'));
    }

    /**
     * Actualizar un servicio.
     */
    public function update(Request $request, General_services $general_service)
    {
        $request->validate([
            'tipus' => 'required|string|max:255',
            'contacte' => 'required|string|max:255',
            'encarregat' => 'required|string|max:255',
            'id_center' => 'required|exists:center,id',
            'observacions' => 'nullable|string',
        ]);

        $general_service->update($request->all());

        return redirect()->route('serveis_generals.index')
                         ->with('success', 'Servicio general actualizado correctamente.');
    }

    /**
     * Eliminar un servicio.
     */
    public function destroy(General_services $general_service)
    {
        $general_service->delete();
        return redirect()->route('serveis_generals.index')
                         ->with('success', 'Servicio general eliminado correctamente.');
    }
}
