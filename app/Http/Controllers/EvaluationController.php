<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Profesional;
use Illuminate\Http\Request;
use App\Traits\Activable;

class EvaluationController extends Controller
{
    use Activable;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluations = Evaluation::with(['profesional', 'avaluador'])
            ->orderBy('data', 'desc')
            ->get();

        $averageSumatori = $evaluations->avg('sumatori');

        return view('evaluation.listarevaluation', compact('evaluations', 'averageSumatori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professionals = Profesional::all();
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
        return view('evaluation.show', compact('evaluation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        $professionals = Profesional::all();

        // Cargar las respuestas existentes en clave-valor
        $oldValues = [];
        for ($i = 0; $i < 20; $i++) {
            $oldValues['pregunta'.($i+1)] = $evaluation->{'q'.$i};
        }

        return view('evaluation.formulario_editar', compact('evaluation', 'professionals', 'oldValues'));
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

        // Guardar archivo si existe
        if ($request->hasFile('arxiu')) {
            $validated['arxiu'] = $request->file('arxiu')->store('evaluations', 'public');
        }

        // Actualizar preguntas q0..q19
        for ($i = 1; $i <= 20; $i++) {
            $validated['q'.($i-1)] = $request->input('pregunta'.$i);
        }

        $evaluation->update($validated);

        return redirect()->route('evaluation.index')
            ->with('success', 'Evaluació actualitzada correctament.');
    }

    /**
     * Activar/desactivar evaluación.
     */
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
