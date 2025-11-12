<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesional;
use App\Models\Center;
use App\Models\Projectes_comissions;
use Illuminate\Support\Facades\DB;
use App\Traits\Activable;

class Projectes_comissionsController extends Controller
{
    use Activable;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectes = Projectes_comissions::get();
        return view('projectes_comissions.lista', ["projectes" => $projectes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centres = Center::get(); 
        $professionals = Profesional::get();

        return view('projectes_comissions.projectes_comissions', [
            "centres" => $centres,
            "professionals" => $professionals
        ]);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // Validar los datos con los nombres correctos de las tablas
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'tipus' => 'required|string|in:projecte,comissio',
            'data_inici' => 'required|date',
            'profesional_id' => 'required|exists:profesional,id', // tabla correcta
            'descripcio' => 'required|string',
            'observacions' => 'nullable|string',
            'centre_id' => 'required|exists:center,id', // tabla correcta
            'estat' => 'required|boolean',
        ]);

        // Insertar en la base de datos usando DB::table
        DB::table('projectes_comissions')->insert([
            'nom' => $validated['nom'],
            'tipus' => $validated['tipus'],
            'data_inici' => $validated['data_inici'],
            'profesional_id' => $validated['profesional_id'],
            'descripcio' => $validated['descripcio'],
            'observacions' => $validated['observacions'] ?? null,
            'centre_id' => $validated['centre_id'],
            'estat' => $validated['estat'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('projectes_comissions.index')
                         ->with('success', 'Projecte/Comissió creat correctament.');
    }

    /**
     * Display the specified resource.
     */
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
        $professionals = Profesional::get();
        $centres = Center::get();

        return view('projectes_comissions.formulario_editar', compact('projectes_comission', 'professionals', 'centres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projectes_comissions $projectes_comission)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'tipus' => 'required|string|in:projecte,comissio',
            'data_inici' => 'required|date',
            'profesional_id' => 'required|exists:profesional,id', // tabla correcta
            'descripcio' => 'required|string',
            'observacions' => 'nullable|string',
            'centre_id' => 'required|exists:center,id', // tabla correcta
            'estat' => 'required|boolean',
        ]);

        $projectes_comission->update($validated);

        return redirect()->route('projectes_comissions.index')
                         ->with('success', 'Projecte/Comissió actualitzat correctament.');
    }

    /**
     * Activar un proyecto o comisión.
     */
    public function active(Projectes_comissions $projectes_comissions)
{
    // Solo invertimos el estado
    $projectes_comissions->estat = !$projectes_comissions->estat;
    $projectes_comissions->save();

    return redirect()->route('projectes_comissions.index')
                     ->with('success', 'Estat canviat correctament.');
}

    /**
     * Desactivar un proyecto o comisión.
     */
    public function destroy(Projectes_comissions $projectes_comission)
    {
        return $this->toggleActive($projectes_comission, false, 'projectes_comissions.index');
    }
}
