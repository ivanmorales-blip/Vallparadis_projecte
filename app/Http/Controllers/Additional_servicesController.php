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
        return view('serveis_adicionals.lista', ['services' => $services]);
    }

    /**
     * Mostrar formulario de alta.
     */
    public function create()
    {
        $centers = Center::all();
        return view('serveis_adicionals.alta', ['centers' => $centers]);
    }

    /**
     * Guardar un servicio general.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipus'        => 'required|string|max:255',
            'contacte'     => 'required|string|max:255',
            'responsable'  => 'required|string|max:255',
            'data_inici'   => 'required|date',
            'centre_id'    => 'required|exists:center,id',
            'observacions' => 'nullable|string',
        ]);

        Additional_services::create($request->all());

        return redirect()->route('serveis_adicionals.index')
            ->with('success', 'Servicio adicional añadido correctamente.');
    }

    /**
     * Mostrar un servicio específico.
     */
    public function show(Additional_services $serveis_adicional)
    {
        return view('serveis_adicionals.show', ['aditional_services' => $serveis_adicional]);
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Additional_services $serveis_adicionals)
    {
        return view('serveis_adicionals.editar', ['serveis_adicionals' => $serveis_adicionals]);
    }

    /**
     * Actualizar un servicio.
     */
    public function update(Request $request, Additional_services $serveis_adicional)
    {
        $request->validate([
            'tipus'        => 'required|string|max:255',
            'contacte'     => 'required|string|max:255',
            'responsable'  => 'required|string|max:255',
            'data_inici'   => 'required|date',
            'centre_id'    => 'required|exists:center,id',
            'observacions' => 'nullable|string',
        ]);

        $serveis_adicional->update($request->only([
            'tipus', 'contacte', 'responsable', 'data_inici', 'centre_id', 'observacions'
        ]));

        return redirect()->route('serveis_adicionals.index')
                        ->with('success', 'Servicio general actualizado correctamente.');
    }


    /**
     * Eliminar un servicio.
     */
    public function destroy(Additional_services $serveis_adicional)
    {
    $serveis_adicional->delete();

    return redirect()
        ->route('serveis_adicionals.index')
        ->with('success', 'Servicio eliminado correctamente.');
    }


}
