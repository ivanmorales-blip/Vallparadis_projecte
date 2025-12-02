<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projectes_comissions;
use App\Models\Profesional;
use App\Models\Center;
use Illuminate\Support\Facades\DB;
use App\Traits\CenterFilterable;
use App\Traits\Activable;

class Projectes_comissionsController extends Controller
{
    use Activable, CenterFilterable;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('projectes_comissions.projectes');
    }

    public function projectes()
    {
        $projectes = $this->projectsInCenter()
            ->where('tipus', 'projecte')
            ->with('profesional')
            ->get();

        return view('projects.projects', ['projectes' => $projectes]);
    }

    public function comissions()
    {
        $comissions = $this->projectsInCenter()
            ->where('tipus', 'comissio')
            ->with('profesional')
            ->get();

        return view('projectes_comissions.comissions', ['comissions' => $comissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centres = Center::find($this->currentCenterId());
        $professionals = $this->professionalsInCenter()->get();
        return view('projectes_comissions.projectes_comissions', [
            'professionals' => $professionals,
            'centre' => $centres
        ]);
    }

    /**
     * Store a newly created resource in storage.
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
        $validated['centre_id'] = $this->currentCenterId();

        DB::table('projectes_comissions')->insert(array_merge($validated, [
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        return redirect()->route(
            $validated['tipus'] === 'projecte' ? 'projectes_comissions.projectes' : 'projectes_comissions.comissions'
        )->with('success', 'Projecte/Comissió creat correctament.');
    }

    public function show(Projectes_comissions $projectes_comission)
    {
        if ($projectes_comission->tipus === 'projecte') {
            $projecte = $projectes_comission->load(['profesional', 'centre']);
            return view('projects.show', compact('projecte'));
        }else {
        $projecte = $projectes_comission->load(['profesional', 'centre']);
        return view('projectes_comissions.show', compact('projecte'));
        }
    }

    public function edit(Projectes_comissions $projectes_comission)
    {
        $professionals =  $this->professionalsInCenter()->get();
        $centres = Center::all();
        return view('projectes_comissions.formulario_editar', [
            'projectes_comission' => $projectes_comission,
            'professionals' => $professionals,
            'centres' => $centres
        ]);
    }

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

        return redirect()->route(
            $validated['tipus'] === 'projecte' ? 'projectes_comissions.projectes' : 'projectes_comissions.comissions'
        )->with('success', 'Projecte/Comissió actualitzat correctament.');
    }

    public function active(Projectes_comissions $projectes_comission)
    {
        $projectes_comission->estat = !$projectes_comission->estat;
        $projectes_comission->save();

        return redirect()->back()->with('success', 'Estat canviat correctament.');
    }

    public function destroy(Projectes_comissions $projectes_comission)
    {
        $projectes_comission->delete();
        return redirect()->back()->with('success', 'Projecte/Comissió eliminat correctament.');
    }

    /**
     * Mostrar la vista para añadir profesionales a un proyecto
     */
    public function addProfessionals(Projectes_comissions $projectes_comission)
    {
        // Profesionales ya asignados al proyecto
        $assignedProfessionals = $projectes_comission->professionals()->get();

        // Profesionales disponibles (ejemplo: todos los del mismo centro que no estén asignados)
        $availableProfessionals = Profesional::where('id_center', $projectes_comission->centre_id)
            ->whereNotIn('id', $assignedProfessionals->pluck('id'))
            ->get();

        return view('projectes_comissions.afegir_profesionals', [
            'projecte' => $projectes_comission,
            'assignedProfessionals' => $assignedProfessionals,
            'availableProfessionals' => $availableProfessionals
        ]);
    }

    /**
     * Guardar los profesionales asignados a un proyecto
     */
    public function updateProfessionals(Request $request, Projectes_comissions $projectes_comission)
    {
        // Validación de los IDs enviados
        $request->validate([
            'professionals' => 'nullable|array',
            'professionals.*' => 'exists:profesional,id',
        ]);

        // Sincroniza los profesionales con el proyecto (añade o quita automáticamente)
        $projectes_comission->professionals()->sync($request->professionals ?? []);

        return response()->json(['success' => true]);
    }
}
