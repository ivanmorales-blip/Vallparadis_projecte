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
    $request->validate([
        'data' => 'required|date',
        'sumatori' => 'required|numeric',
        'observacions' => 'nullable|string',
        'arxiu' => 'nullable|file',
        'id_profesional' => 'required|exists:profesional,id',
        'id_profesional_avaluador' => 'nullable|exists:profesional,id',
    ]);

    $rutaArchivo = $request->hasFile('arxiu') 
        ? $request->file('arxiu')->store('evaluations', 'public') 
        : null;

    $evaluation = new Evaluation();
    $evaluation->data = $request->input('data');
    $evaluation->sumatori = $request->input('sumatori');
    $evaluation->observacions = $request->input('observacions');
    $evaluation->arxiu = $rutaArchivo;
    $evaluation->id_profesional = $request->input('id_profesional');
    $evaluation->id_profesional_avaluador = $request->input('id_profesional_avaluador');

    // Store all question answers
    for ($i = 0; $i < 20; $i++) {
        $evaluation->{'q'.$i} = $request->input('q'.$i);
    }

    $evaluation->save();

    return redirect()->route('evaluation.index')
        ->with('success', 'Avaluació guardada correctament.');
}


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
            ->with('success', 'Avaluació actualitzada correctament.');
    }

    use Activable;

    public function active(Evaluation $evaluation)
    {
        return $this->toggleActive($evaluation, true, 'evaluations.index');
    }

    public function destroy(Evaluation $evaluation)
    {
        return $this->toggleActive($evaluation, false, 'evaluations.index');
    }
}
