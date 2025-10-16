<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesional;
use App\Models\Center;
use App\Models\Projectes_comissions;

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
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'tipus' => 'required|string|max:255',
        'data_inici' => 'required|date',
        'profesional_id' => 'required|integer',
        'descripcio' => 'required|string',
        'observacions' => 'nullable|string',
        'centre_id' => 'required|integer',
    ]);

    Projectes_comissions::create($validated);

    // Redirige a la lista de proyectos/comisiones
    return redirect()->route('projectes_comissions.index')
                     ->with('success', 'Projecte creat correctament.');
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
    public function edit(Projectes_comissions $projecte)
{
    $professionals = Profesional::all();
    $centres = Center::all();
    return view('projectes_comissions.formulario_editar', compact('projecte', 'professionals', 'centres'));
}

    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projectes_comissions $projecte)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'tipus' => 'required|string|max:255',
        'data_inici' => 'required|date',
        'profesional_id' => 'required|integer',
        'descripcio' => 'required|string',
        'observacions' => 'nullable|string',
        'centre_id' => 'required|integer',
    ]);

    $projecte->update($validated);

    return redirect()->route('projectes_comissions.index')
                     ->with('success', 'Projecte actualitzat correctament.');
}

    

    /**
     * Remove the specified resource from storage.
     */
    // Desactivar un proyecto (marca como inactivo)
public function destroy(Projectes_comissions $projecte)
{
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
