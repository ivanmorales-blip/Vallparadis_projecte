<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projectes_comissions;
use App\Models\Profesional;
use App\Models\Center;
use App\Traits\CenterFilterable;
use App\Traits\Activable;
use Illuminate\Support\Facades\DB;


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
        return view('projectes_comissions.projectes_comissions', ['professionals' => $professionals, 'centre' => $centres]);
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
        $projecte = $projectes_comission->load(['profesional', 'centre']);
        return view('projectes_comissions.show', compact('projecte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projectes_comissions $projectes_comission)
    {
        $professionals =  $this->professionalsInCenter()->get();
        $centres = Center::all();
        return view('projectes_comissions.formulario_editar', ['projectes_comission' => $projectes_comission, 'professionals' => $professionals, 'centres' => $centres]);
    }

    /**
     * Display the specified resource.
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

        return redirect()->route(
            $validated['tipus'] === 'projecte' ? 'projectes_comissions.projectes' : 'projectes_comissions.comissions'
        )->with('success', 'Projecte/Comissió actualitzat correctament.');
    }

    /**
     * 
     */
    public function active(Projectes_comissions $projectes_comission)
    {
        $projectes_comission->estat = !$projectes_comission->estat;
        $projectes_comission->save();

        return redirect()->back()->with('success', 'Estat canviat correctament.');
    }

    /**
     *
     */
    public function destroy(Projectes_comissions $projectes_comission)
    {
        $projectes_comission->delete();
        return redirect()->back()->with('success', 'Projecte/Comissió eliminat correctament.');
    }
}
