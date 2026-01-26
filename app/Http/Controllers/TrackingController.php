<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\Profesional;
use App\Models\General_services;
use App\Models\Maintenance;
use App\Models\TemaPendent;
use App\Traits\Activable;
use App\Traits\CenterFilterable;

class TrackingController extends Controller
{
    use Activable, CenterFilterable;

    /* ==========================================================
     |  SEGUIMENTS ORIENTATS A PROFESSIONALS
     ========================================================== */

    public function indexForProfessional()
    {
        // No se usa actualmente
    }

    // FORMULARIO DE CREACIÓN DE SEGUIMENT PARA UN PROFESIONAL
    public function createForProfesional($profesionalId = null)
    {
        $professionals = $this->professionalsInCenter()->get();
        $disableProfessionalSelect = $profesionalId ? true : false;

        return view('tracking.formulario_alta', [
            'professionals' => $professionals,
            'selectedProfesional' => $profesionalId,
            'disableProfessionalSelect' => $disableProfessionalSelect,
        ]);
    }

    // GUARDAR SEGUIMENT DE PROFESIONAL
    public function storeForProfesional(Request $request)
    {
        $validated = $request->validate([
            'tema' => 'required|string|max:255',
            'data' => 'required|date',
            'observacions' => 'nullable|string',
            'id_profesional' => 'required|exists:profesional,id',
            'tipus' => 'required|string',
            'comentari' => 'required|string',
            'id_profesional_registrador' => 'required|exists:profesional,id',
        ]);

        Tracking::create($validated);

        return redirect()->route('menu')
            ->with('success', 'Seguiment del professional creat correctament.');
    }

    // MOSTRAR UN SEGUIMENT DE PROFESIONAL
    public function showForProfesional(Tracking $tracking)
    {
        $tracking->load(['profesional', 'registrador']);
        return view('tracking.show', compact('tracking'));
    }

    // FORMULARIO DE EDICIÓN DE SEGUIMENT DE PROFESIONAL
    public function editForProfesional(Tracking $tracking)
    {
        $professionals = $this->professionalsInCenter()->get();

        return view('tracking.formulario_editar', [
            'tracking' => $tracking,
            'professionals' => $professionals,
            'selectedProfesional' => $tracking->id_profesional,
            'disableProfessionalSelect' => true,
        ]);
    }

    // ACTUALIZAR SEGUIMENT DE PROFESIONAL
    public function updateForProfesional(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'tema' => 'required|string|max:255',
            'data' => 'required|date',
            'observacions' => 'nullable|string',
            'id_profesional' => 'required|exists:profesional,id',
            'id_profesional_registrador' => 'required|exists:profesional,id',
            'tipus' => 'required|string',
            'comentari' => 'required|string',
        ]);

        $tracking->update($validated);

        return redirect()->route('menu')
            ->with('success', 'Seguiment del professional actualitzat correctament.');
    }

    // ACTIVAR / DESACTIVAR SEGUIMENT DE PROFESIONAL
    public function activeForProfesional(Tracking $tracking)
    {
        return $this->toggleActive($tracking, true, 'tracking.indexForProfesional');
    }

    // ELIMINAR SEGUIMENT DE PROFESIONAL
    public function destroyForProfesional(Tracking $tracking)
    {
        return $this->toggleActive($tracking, false, 'tracking.indexForProfesional');
    }


    /* ==========================================================
     |  SEGUIMENTS ORIENTATS A SERVEIS GENERALS
     |  (pendents d’implementar)
     ========================================================== */

   // Seguiments de Serveis Generals
    public function indexForGeneralService($generalServiceId)
    {
        //no la necesito
    }

    public function createForGeneralService($generalServiceId)
    {
        $professionals = $this->professionalsInCenter()->get();
        $generalService = General_services::findOrFail($generalServiceId);

        return view('tracking.tracking_general_service.alta', [
            'professionals' => $professionals,
            'generalService' => $generalService
        ]);
    }


    public function storeForGeneralService(Request $request)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'tema' => 'required|string|max:255',
            'tipus' => 'required|string|max:255',
            'comentari' => 'required|string',
            'id_profesional' => 'required|exists:profesional,id',
            'id_general_services' => 'required|exists:general_services,id',
        ]);

        Tracking::create($validated);

        return redirect()->route('general_services.show', $validated['id_general_services'])
                        ->with('success', 'Seguiment creat correctament.');
    }

    public function showForGeneralService(Tracking $tracking)
    {
        // Cargar relaciones necesarias
        $tracking->load(['profesional', 'registrador']);

        return view('tracking.tracking_general_service.show', compact('tracking'));
    }


    public function editForGeneralService(Tracking $tracking)
    {
        $professionals = $this->professionalsInCenter()->get();

        return view('tracking.tracking_general_service.editar', [
            'tracking' => $tracking,
            'professionals' => $professionals
        ]);
    }

    public function updateForGeneralService(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'tema' => 'required|string|max:255',
            'tipus' => 'required|string|max:255',
            'comentari' => 'required|string',
            'id_profesional' => 'required|exists:profesional,id',
        ]);

        $tracking->update($validated);

        return redirect()->route('general_services.show', $tracking->id_general_services)
                        ->with('success', 'Seguiment actualitzat correctament.');
    }

    public function destroyForGeneralService(Tracking $tracking)
    {
        $tracking->delete();

        return redirect()->route('general_services.show', $tracking->id_general_services)
                        ->with('success', 'Seguiment eliminat correctament.');
    }
    /* ==========================================================
    |  SEGUIMENTS ORIENTATS A MANTENIMENT
    ========================================================== */

    public function createForMaintenance($maintenanceId)
    {
        $professionals = $this->professionalsInCenter()->get();
        $maintenance = Maintenance::findOrFail($maintenanceId);

        return view('tracking.tracking_maintenance.tracking_maintenance_alta', [
            'professionals' => $professionals,
            'maintenance' => $maintenance
        ]);

    }

    public function storeForMaintenance(Request $request)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'tema' => 'required|string|max:255',
            'tipus' => 'required|string|max:255',
            'comentari' => 'required|string',
            'id_profesional' => 'required|exists:profesional,id',
            'id_manteniment' => 'required|exists:maintenance,id',
        ]);

        Tracking::create($validated);

        return redirect()->route('manteniment.show', $validated['id_manteniment'])
                        ->with('success', 'Seguiment creat correctament.');
    }

    public function showForMaintenance(Tracking $tracking)
    {
        $tracking->load(['profesional', 'registrador']);

        return view('tracking.tracking_maintenance.tracking_maintenance_show.', compact('tracking'));
    }

    public function editForMaintenance(Tracking $tracking)
    {
        $professionals = $this->professionalsInCenter()->get();

        return view('tracking.tracking_maintenance.editar', [
            'tracking' => $tracking,
            'professionals' => $professionals
        ]);
    }

    public function updateForMaintenance(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'tema' => 'required|string|max:255',
            'tipus' => 'required|string|max:255',
            'comentari' => 'required|string',
            'id_profesional' => 'required|exists:profesional,id',
        ]);

        $tracking->update($validated);

        return redirect()->route('maintenance.show', $tracking->id_manteniment)
                        ->with('success', 'Seguiment actualitzat correctament.');
    }

    public function destroyForMaintenance(Tracking $tracking)
    {
        $tracking->delete();

        return redirect()->route('maintenance.show', $tracking->id_manteniment)
                        ->with('success', 'Seguiment eliminat correctament.');
    }
    /**
     * FORMULARIO DE CREACIÓN DE SEGUIMENT PARA RECURSOS HUMANS
     */
    public function createForHumanResource($humanResourceId)
    {
        $professionals = $this->professionalsInCenter()->get();
        $humanResource = TemaPendent::findOrFail($humanResourceId);

        return view('tracking.tracking_human_resource.tracking_human_resource_alta', [
            'professionals' => $professionals,
            'humanResource' => $humanResource
        ]);
    }

    /**
     * GUARDAR SEGUIMENT PARA RECURSOS HUMANS
     */
    public function storeForHumanResource(Request $request)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'tema' => 'required|string|max:255',
            'tipus' => 'required|string|max:255',
            'comentari' => 'required|string',
            'id_profesional' => 'required|exists:profesional,id',
            'id_human_resource' => 'required|exists:temes_pendents,id',
        ]);

        Tracking::create($validated);

        return redirect()->route('human_resources.show', $validated['id_human_resource'])
                         ->with('success', 'Seguiment creat correctament.');
    }

    /**
     * MOSTRAR UN SEGUIMENT ORIENTAT A RECURSOS HUMANS
     */
    public function showForHumanResource(Tracking $tracking)
    {
        $tracking->load(['profesional', 'registrador']);

        // Traemos el TemaPendent asociado para mostrar información completa
        $tema = TemaPendent::with('profesional', 'professionalRegistra', 'derivatA', 'trackings')
                           ->findOrFail($tracking->id_human_resource);

        return view('tracking.tracking_human_resource.tracking_human_resource_show', compact('tracking', 'tema'));
    }

    /**
     * FORMULARIO DE EDICIÓN DE SEGUIMENT
     */
    public function editForHumanResource(Tracking $tracking)
    {
        $professionals = $this->professionalsInCenter()->get();

        return view('tracking.tracking_human_resource.editar', [
            'tracking' => $tracking,
            'professionals' => $professionals
        ]);
    }

    /**
     * ACTUALIZAR SEGUIMENT
     */
    public function updateForHumanResource(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'tema' => 'required|string|max:255',
            'tipus' => 'required|string|max:255',
            'comentari' => 'required|string',
            'id_profesional' => 'required|exists:profesional,id',
        ]);

        $tracking->update($validated);

        return redirect()->route('human_resources.show', $tracking->id_human_resource)
                         ->with('success', 'Seguiment actualitzat correctament.');
    }

    /**
     * ELIMINAR SEGUIMENT
     */
    public function destroyForHumanResource(Tracking $tracking)
    {
        $tracking->delete();

        return redirect()->route('human_resources.show', $tracking->id_human_resource)
                         ->with('success', 'Seguiment eliminat correctament.');
    }

}
