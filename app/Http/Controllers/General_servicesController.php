<?php

namespace App\Http\Controllers;

use App\Models\General_services;
use App\Models\Center;
use App\Models\Tracking;
use App\Models\Profesional;
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
        $centers = Center::all(); 
        $profesionals = Profesional::all(); // Para seleccionar en los seguimientos
        return view('serveis_generals.alta', compact('centers', 'profesionals'));
    }

    /**
     * Guardar un servicio general y sus seguimientos.
     */
    public function store(Request $request)
    {
        // Validación del servicio
        $request->validate([
            'tipus' => 'required|string|max:255',
            'contacte' => 'required|string|max:255',
            'encarregat' => 'required|string|max:255',
            'horari' => 'required|string|max:255',
            'id_center' => 'required|exists:center,id',
            'observacions' => 'nullable|string',
            'trackings.*.tipus' => 'required_with:trackings.*|string|max:255',
            'trackings.*.data' => 'required_with:trackings.*|date',
            'trackings.*.tema' => 'required_with:trackings.*|string|max:255',
            'trackings.*.comentari' => 'nullable|string',
            'trackings.*.id_profesional' => 'required_with:trackings.*|exists:profesional,id',
        ]);

        // Crear el servicio general
        $service = General_services::create($request->only([
            'tipus', 'contacte', 'encarregat', 'horari', 'observacions', 'id_center'
        ]));

        // Guardar los seguimientos si existen
        if ($request->has('trackings')) {
            foreach ($request->trackings as $trackingData) {
                $service->trackings()->create($trackingData);
            }
        }

        return redirect()->route('general_services.index')
                         ->with('success', 'Servicio general y seguimientos añadidos correctamente.');
    }

    /**
     * Mostrar un servicio específico.
     */
    public function show(General_services $general_service)
    {
        $general_service->load('trackings.profesional'); // Cargar seguimientos y profesionales
        return view('serveis_generals.show', compact('general_service'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(General_services $general_service)
    {
        $centers = Center::all();
        $profesionals = Profesional::all();
        $general_service->load('trackings');
        return view('serveis_generals.alta', compact('general_service', 'centers', 'profesionals'));
    }

    /**
     * Actualizar un servicio general y sus seguimientos.
     */
    public function update(Request $request, General_services $general_service)
    {
        // Validación igual que en store
        $request->validate([
            'tipus' => 'required|string|max:255',
            'contacte' => 'required|string|max:255',
            'encarregat' => 'required|string|max:255',
            'horari' => 'required|string|max:255',
            'id_center' => 'required|exists:center,id',
            'observacions' => 'nullable|string',
            'trackings.*.tipus' => 'required_with:trackings.*|string|max:255',
            'trackings.*.data' => 'required_with:trackings.*|date',
            'trackings.*.tema' => 'required_with:trackings.*|string|max:255',
            'trackings.*.comentari' => 'nullable|string',
            'trackings.*.id_profesional' => 'required_with:trackings.*|exists:profesional,id',
        ]);

        // Actualizar servicio general
        $general_service->update($request->only([
            'tipus', 'contacte', 'encarregat', 'horari', 'observacions', 'id_center'
        ]));

        // Actualizar seguimientos
        if ($request->has('trackings')) {
            foreach ($request->trackings as $trackingData) {
                if (isset($trackingData['id'])) {
                    // Actualizar seguimiento existente
                    $tracking = Tracking::find($trackingData['id']);
                    if ($tracking) {
                        $tracking->update($trackingData);
                    }
                } else {
                    // Crear seguimiento nuevo
                    $general_service->trackings()->create($trackingData);
                }
            }
        }

        return redirect()->route('general_services.index')
                         ->with('success', 'Servicio general actualizado correctamente.');
    }

    /**
     * Eliminar un servicio.
     */
    public function destroy(General_services $general_service)
    {
        $general_service->delete();
        return redirect()->route('general_services.index')
                         ->with('success', 'Servicio general eliminado correctamente.');
    }
}
