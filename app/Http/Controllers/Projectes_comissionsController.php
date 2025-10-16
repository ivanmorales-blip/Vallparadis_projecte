<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesional;
use App\Models\Center;
use App\Models\Projectes_comissions;
use Illuminate\Support\Facades\DB;


class Projectes_comissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectes = Projectes_comissions::all();

        return view('projectes_comissions.lista', compact ('projectes'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centres = Center::all(); 
        $professionals = Profesional::all();
        
    return view('projectes_comissions.projectes_comissions', compact('centres', 'professionals'));


    
    }

    /**
     * Store a newly created resource in storage.
     */
   
    public function store(Request $request)
{   dd($request->all());
    // Validate inputs (including centre_id)
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'tipus' => 'required|string|max:255',
        'data_inici' => 'required|date',
        'profesional_id' => 'required|exists:profesional,id',
        'descripcio' => 'required|string',
        'observacions' => 'nullable|string',
        'centre_id' => 'required|exists:center,id',  // Make sure centre_id is validated
    ]);

    // Insert into the DB with centre_id included
    DB::table('projectes_comissions')->insert([
        'nom' => $validated['nom'],
        'tipus' => $validated['tipus'],
        'data_inici' => $validated['data_inici'],
        'profesional_id' => $validated['profesional_id'],
        'descripcio' => $validated['descripcio'],
        'observacions' => $validated['observacions'] ?? null,
        'centre_id' => $validated['centre_id'],  // Make sure this is passed in the insert!
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Redirect or return response
    return redirect()->route('projectes_comissions.index')->with('success', 'Project inserted successfully.');
}

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projectes_comissions $projectes_comission)
{
    $professionals = Profesional::all();
    $centres = Center::all();
    return view('projectes_comissions.formulario_editar', compact('projectes_comission', 'professionals', 'centres'));
}

    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projectes_comissions $projectes_comission)
{
    // Now use $projectes_comission instead of $projecte
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'tipus' => 'required|string|max:255',
        'data_inici' => 'required|date',
        'profesional_id' => 'required|integer',
        'descripcio' => 'required|string',
        'observacions' => 'nullable|string',
        'centre_id' => 'required|integer',
    ]);

    $projectes_comission->update($validated);

    return redirect()->route('projectes_comissions.index')
                     ->with('success', 'Projecte actualitzat correctament.');
}


    

    /**
     * Remove the specified resource from storage.
     */
    // Desactivar un proyecto (marca como inactivo)
public function destroy($id)
{
    $projecte = Projectes_comissions::findOrFail($id);

    $projecte->estat = false;
    $projecte->save();

    return redirect()->route('projectes_comissions.index')
                     ->with('success', 'Projecte desactivat correctament.');
}


// Activar un proyecto
public function active(Projectes_comissions $projecte)
{
    $projecte->estat = true;
    $projecte->save();
    return redirect()->route('projectes_comissions.index')
                     ->with('success', 'Projecte activat correctament.');
}
}
