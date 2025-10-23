<?php

namespace App\Http\Controllers;
use App\Models\Evaluation;

use Illuminate\Http\Request;
use App\Models\Profesional;
use App\Models\Center;
use App\Models\Projectes_comissions;
use Illuminate\Support\Facades\DB;
use App\Traits\Activable;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
    {
        $evaluations = Evaluation::with(['profesional', 'profesionalAvaluador'])->get();
        return view('evaluation.listarevaluation', compact('evaluations'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centres = Center::all(); 
        $professionals = Profesional::all();
        
        return view('evaluation.evaluation', compact('centres', 'professionals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'data' => 'required|date',
        'sumatori' => 'required|numeric',
        'observacions' => 'nullable|string',
        'arxiu' => 'nullable|file',
        'id_profesional' => 'required|exists:profesional,id',
        'id_profesional_avaluador' => 'nullable|exists:profesional,id',
    ]);

    $rutaArchivo = null;
    if ($request->hasFile('arxiu')) {
        $rutaArchivo = $request->file('arxiu')->store('evaluations', 'public');
    }

    
    Evaluation::create([
        'data' => $request->data,
        'sumatori' => $request->sumatori,
        'observacions' => $request->observacions,
        'arxiu' => $rutaArchivo,
        'id_profesional' => $request->id_profesional,
        'id_profesional_avaluador' => $request->id_profesional_avaluador,
        
    ]);

    return redirect()->route('evaluation.index')->with('success', 'Avaluació guardada correctament.');
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
    public function edit(Evaluation $evaluation)
    {
        $professionals = Profesional::all();
        return view('evaluation.formulario_editar', compact('evaluation', 'professionals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'sumatori' => 'required|numeric',
            'observacions' => 'nullable|string',
            'arxiu' => 'nullable|file',
            'id_profesional' => 'required|exists:profesional,id',
            'id_profesional_avaluador' => 'required|exists:profesional,id',
        ]);


        if ($request->hasFile('arxiu')) {
            $validated['arxiu'] = $request->file('arxiu')->store('evaluations', 'public');
        } else {
            unset($validated['arxiu']);
        }

        
        $evaluation->update($validated);
        return redirect()->route('evaluation.index')
                         ->with ('success', 'Evaluació actualitzada correctament.');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    //public function destroy(string $id)
    //{
        //
    //}

    use Activable;

    public function active (Evaluation $evaluation)
    {
        return $this->toggleActive($evaluation, true, 'evaluations.index');
    }

    public function destroy (Evaluation $evaluation)
    {
        return $this->toggleActive($evaluation, false, 'evaluations.index');
    }


}
