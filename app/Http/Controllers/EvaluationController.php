<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Profesional;
use Illuminate\Http\Request;
use App\Traits\Activable;
use App\Traits\CenterFilterable;
use Illuminate\Support\Facades\Storage;

class EvaluationController extends Controller
{
    use Activable, CenterFilterable;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluations = Evaluation::with(['profesional', 'profesionalAvaluador'])
            ->whereHas('profesional', function($query) {
                $query->where('id_center', session('id_center'));
            })
            ->get();


        $averageSumatori = $evaluations->avg('sumatori');

        return view('evaluation.listarevaluation', [
            'evaluations' => $evaluations
        ]);
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
        $validated = $request->validate([
            'data' => 'required|date',
            'sumatori' => 'required|numeric',
            'observacions' => 'nullable|string',
            'arxiu' => 'nullable|file',
            'id_profesional' => 'required|exists:profesional,id',
            'id_profesional_avaluador' => 'nullable|exists:profesional,id',
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

        $evaluationData = [
            'data' => $validated['data'],
            'sumatori' => $validated['sumatori'],
            'observacions' => $validated['observacions'] ?? null,
            'id_profesional' => $validated['id_profesional'],
            'id_profesional_avaluador' => $validated['id_profesional_avaluador'] ?? null,
        ];

        // Guardar archivo si existe
        if ($request->hasFile('arxiu')) {
            $evaluationData['arxiu'] = $request->file('arxiu')->store('evaluations', 'public');
        }

        // Guardar preguntas q0..q19 basadas en input pregunta1..pregunta20
        for ($i = 1; $i <= 20; $i++) {
            $evaluationData['q'.($i-1)] = $request->input('pregunta'.$i);
        }

        Evaluation::create($evaluationData);

        return redirect()->route('evaluation.index')
            ->with('success', 'Avaluació guardada correctament.');
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
        $validated = $request->validate(array_merge([
            'data' => 'required|date',
            'sumatori' => 'required|numeric',
            'observacions' => 'nullable|string',
            'arxiu' => 'nullable|file',
            'id_profesional' => ['required', $this->professionalRule()],
            'id_profesional_avaluador' => ['required', $this->professionalRule()],
        ], $this->questionValidationRules()));

        if ($request->hasFile('arxiu')) {
            if ($evaluation->arxiu && Storage::disk('public')->exists($evaluation->arxiu)) {
                Storage::disk('public')->delete($evaluation->arxiu);
            }
            $validated['arxiu'] = $request->file('arxiu')->store('evaluations', 'public');
        }

        $evaluation->update($validated);

        return redirect()->route('evaluation.index')->with('success', 'Evaluació actualitzada correctament.');
    }

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

    private function questionValidationRules()
    {
        $rules = [];
        for ($i = 1; $i <= 20; $i++) {
            $rules['pregunta'.$i] = 'nullable|integer';
        }
        return $rules;
    }
}
