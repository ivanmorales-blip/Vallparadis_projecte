<?php

namespace App\Http\Controllers;
use App\Models\Evaluation;

use Illuminate\Http\Request;
use App\Models\Profesional;
use App\Models\Center;
use App\Models\Projectes_comissions;
use Illuminate\Support\Facades\DB;
use App\Traits\Activable;

use Illuminate\Support\Facades\Storage; // asegúrate de tener este use arriba del archivo


class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $evaluations = Evaluation::with(['profesional', 'profesionalAvaluador'])
        ->orderBy('data', 'desc')
        ->get();

    // Promedio global del campo sumatori
    $averageSumatori = $evaluations->avg('sumatori');

    return view('evaluation.listarevaluation', compact('evaluations', 'averageSumatori'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professionals = Profesional::all();

        // Obtenemos el ID del profesional desde query string
        $selectedProfesional = request()->query('profesional', null);

        return view('evaluation.evaluation', [
            'professionals' => $professionals,
            'selectedProfesional' => $selectedProfesional,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    
    $validated = $request->validate([
        'data' => 'required|date',
        'sumatori' => 'required|numeric',
        'observacions' => 'nullable|string',
        'arxiu' => 'nullable|file', 
        'id_profesional' => 'required|exists:profesional,id',
        'id_profesional_avaluador' => 'required|exists:profesional,id',
        'pregunta1' => 'nullable|integer',
        'pregunta2' => 'nullable|integer',
        'pregunta3' => 'nullable|integer',
        'pregunta4' => 'nullable|integer',
        'pregunta5' => 'nullable|integer',
        'pregunta6' => 'nullable|integer',
        'pregunta7' => 'nullable|integer',
        'pregunta8' => 'nullable|integer',
        'pregunta9' => 'nullable|integer',
        'pregunta10' => 'nullable|integer',
        'pregunta11' => 'nullable|integer',
        'pregunta12' => 'nullable|integer',
        'pregunta13' => 'nullable|integer',
        'pregunta14' => 'nullable|integer',
        'pregunta15' => 'nullable|integer',
        'pregunta16' => 'nullable|integer',
        'pregunta17' => 'nullable|integer',
        'pregunta18' => 'nullable|integer',
        'pregunta19' => 'nullable|integer',
        'pregunta20' => 'nullable|integer',
    ]);

    $evaluation = new \App\Models\Evaluation();

    
    $evaluation->data = $validated['data'];
    $evaluation->sumatori = $validated['sumatori'];
    $evaluation->observacions = $validated['observacions'] ?? null;
    $evaluation->id_profesional = $validated['id_profesional'];
    $evaluation->id_profesional_avaluador = $validated['id_profesional_avaluador'];

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

    return redirect()->route('evaluation.index')
                     ->with('success', 'Avaluació guardada correctament.');
}



    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        $evaluation->load(['profesional', 'avaluador']);
        return view('evaluation.show', compact('evaluation'));
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

    // 🔹 Guardar el archivo si se ha subido
    if ($request->hasFile('arxiu')) {
        $validated['arxiu'] = $request->file('arxiu')->store('evaluations', 'public');
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

    public function active(Evaluation $evaluation)
{
    $this->toggleActive($evaluation, true);
    return response()->json(['success' => true]);
}

public function destroy(Evaluation $evaluation)
{
    $this->toggleActive($evaluation, false);
    return response()->json(['success' => true]);
}


}
