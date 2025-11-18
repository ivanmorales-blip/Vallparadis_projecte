<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Profesional;
use Illuminate\Http\Request;
use App\Traits\Activable;

class EvaluationController extends Controller
{
    use Activable, CenterFilterable;

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
        $professionals =  $this->professionalsInCenter()->get();
        $selectedProfesional = request()->query('profesional', null);

        // Inicializar array de preguntas con valores nulos
        $oldValues = [];
        for ($i = 1; $i <= 20; $i++) {
            $oldValues['pregunta'.$i] = null;
        }

        return view('evaluation.evaluation', [
            'professionals' => $professionals,
            'selectedProfesional' => $selectedProfesional,
            'oldValues' => $oldValues,
        ]);
    }

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
    public function show(Evaluation $evaluation)
    {
        $evaluation->load(['profesional', 'avaluador']);
        return view('evaluation.show', ['evaluation' => $evaluation]);
    }

    public function edit(Evaluation $evaluation)
    {
        $professionals = $this->professionalsInCenter()->get();

        // Cargar las respuestas existentes en clave-valor
        $oldValues = [];
        for ($i = 0; $i < 20; $i++) {
            $oldValues['pregunta'.($i+1)] = $evaluation->{'q'.$i};
        }

        return view('evaluation.formulario_editar', ['evaluation' => $evaluation,
            'professionals' => $professionals, 'oldValues' => $oldValues]);
    }

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
        $this->toggleActive($evaluation, true);
        return response()->json(['success' => true]);
    }

    public function destroy(Evaluation $evaluation)
    {
        $this->toggleActive($evaluation, false);
        return response()->json(['success' => true]);
    }

    private function questionValidationRules()
    {
        $rules = [];
        for ($i = 1; $i <= 20; $i++) {
            $rules['pregunta'.$i] = 'nullable|integer';
        }
        return $rules;
    }
}
