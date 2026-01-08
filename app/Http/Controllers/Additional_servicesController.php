<?php

namespace App\Http\Controllers;

use App\Models\Additional_services;
use App\Models\Center;
use Illuminate\Http\Request;

class Additional_servicesController extends Controller
{
    /**
     * Listar servicios adicionales.
     */
    public function index()
    {
        $services = Additional_services::with('center')->get();
        return view('serveis_adicionals.lista', compact('services'));
    }

    /**
     * Mostrar formulario de alta.
     */
    public function create()
    {
        $centers = Center::all();
        return view('serveis_adicionals.alta', compact('centers'));
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
            'id_center' => 'required|exists:center,id',
            'observacions' => 'nullable|string',
        ]);

        Additional_services::create($request->all());

        return redirect()->route('serveis_adicionals.index')
            ->with('success', 'Servicio general añadido correctamente.');
    }

    /**
     * Mostrar un servicio específico.
     */
    public function show(Additional_services $general_service)
    {
        return view('serveis_adicionals.show', compact('additional_service'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Additional_services $general_service)
    {
        $centers = Center::all();
        return view('serveis_adicionals.alta', compact('additional_service', 'centers'));
    }

    /**
     * Actualizar un servicio.
     */
    public function update(Request $request, Additional_services $general_service)
    {
        $request->validate([
            'tipus' => 'required|string|max:255',
            'contacte' => 'required|string|max:255',
            'encarregat' => 'required|string|max:255',
            'id_center' => 'required|exists:center,id',
            'observacions' => 'nullable|string',
        ]);

        $general_service->update($request->all());

        return redirect()->route('serveis_adicionals.index')
            ->with('success', 'Servicio general actualizado correctamente.');
    }

    /**
     * Eliminar un servicio.
     */
    public function destroy(Additional_services $general_service)
    {
        $general_service->delete();
        return redirect()->route('serveis_adicionals.index')
            ->with('success', 'Servicio general eliminado correctamente.');
    }
}
