<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Profesional;
use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Activable;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with(['profesional', 'profesionalAvaluador'])->get();
        return view('evaluation.listarevaluation', [
            'evaluations' => $evaluations
        ]);
    }

    public function create()
    {
        $centres = Center::all();
        $professionals = Profesional::all();

        return view('evaluation.evaluation', [
            'centres' => $centres,
            'professionals' => $professionals
        ]);
    }

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
        $evaluation->arxiu = $request->file('arxiu')->store('evaluations'); 
    } else {
        $evaluation->arxiu = null; 
    }

    
    for ($i = 1; $i <= 20; $i++) {
        $evaluation->{'pregunta'.$i} = $request->{'pregunta'.$i} ?? null;
    }

    
    $evaluation->save();

    return redirect()->route('evaluation.index')
                     ->with('success', 'Avaluació guardada correctament.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Evaluation $evaluation)
    {
        $professionals = Profesional::all();

        return view('evaluation.formulario_editar', [
            'evaluation' => $evaluation,
            'professionals' => $professionals
        ]);
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
        return $this->toggleActive($evaluation, true, 'evaluations.index');
    }

    public function destroy (Evaluation $evaluation)
    {
        return $this->toggleActive($evaluation, false, 'evaluations.index');
    }


}
