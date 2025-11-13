<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projectes_comissions;
use App\Models\Profesional;
use App\Models\Center;

class Projectes_comissionsController extends Controller
{
    /**
     * Redirige al listado de proyectos
     */
    public function index()
    {
        return redirect()->route('projectes_comissions.projectes');
    }

    /**
     * Listado solo de proyectos
     */
    public function projectes()
    {
        $projectes = Projectes_comissions::where('tipus', 'projecte')->with('profesional')->get();
        return view('projects.projects', compact('projectes'));
    }

    /**
     * Listado solo de comisiones
     */
    public function comissions()
    {
        $comissions = Projectes_comissions::where('tipus', 'comissio')->with('profesional')->get();
        return view('projectes_comissions.comissions', compact('comissions'));
    }

    /**
     * Formulario para crear proyecto/comisión
     */
    public function create()
    {
        $professionals = Profesional::all();
        $centres = Center::all();
        return view('projectes_comissions.projectes_comissions', compact('professionals', 'centres'));
    }

    /**
     * Guardar proyecto/comisión
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'tipus' => 'required|string|in:projecte,comissio',
            'data_inici' => 'required|date',
            'profesional_id' => 'required|exists:profesional,id',
            'descripcio' => 'required|string',
            'observacions' => 'nullable|string',
            'centre_id' => 'required|exists:center,id',
            'estat' => 'required|boolean',
        ]);

        Projectes_comissions::create($validated);

        return redirect()->route($validated['tipus'] == 'projecte' ? 'projectes_comissions.projectes' : 'projectes_comissions.comissions')
                         ->with('success', 'Projecte/Comissió creat correctament.');
    }

    /**
     * Mostrar detalles
     */
    public function show(Projectes_comissions $projectes_comission)
    {
        $projecte = $projectes_comission->load(['profesional', 'centre']);
        return view('projectes_comissions.show', compact('projecte'));
    }

    /**
     * Formulario para editar
     */
    public function edit(Projectes_comissions $projectes_comission)
    {
        $professionals = Profesional::all();
        $centres = Center::all();
        return view('projectes_comissions.formulario_editar', compact('projectes_comission', 'professionals', 'centres'));
    }

    /**
     * Actualizar proyecto/comisión
     */
    public function update(Request $request, Projectes_comissions $projectes_comission)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'tipus' => 'required|string|in:projecte,comissio',
            'data_inici' => 'required|date',
            'profesional_id' => 'required|exists:profesional,id',
            'descripcio' => 'required|string',
            'observacions' => 'nullable|string',
            'centre_id' => 'required|exists:center,id',
            'estat' => 'required|boolean',
        ]);

        $projectes_comission->update($validated);

        return redirect()->route($validated['tipus'] == 'projecte' ? 'projectes_comissions.projectes' : 'projectes_comissions.comissions')
                         ->with('success', 'Projecte/Comissió actualitzat correctament.');
    }

    /**
     * Activar / Desactivar proyecto/comisión
     */
    public function active(Projectes_comissions $projectes_comission)
    {
        $projectes_comission->estat = !$projectes_comission->estat;
        $projectes_comission->save();

        return redirect()->back()->with('success', 'Estat canviat correctament.');
    }

    /**
     * Eliminar proyecto/comisión
     */
    public function destroy(Projectes_comissions $projectes_comission)
    {
        $projectes_comission->delete();
        return redirect()->back()->with('success', 'Projecte/Comissió eliminat correctament.');
    }
}
