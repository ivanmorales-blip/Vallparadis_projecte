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
        // Obtener todas las evaluaciones con sus relaciones cargadas
        $evaluations = Evaluation::with(['profesional', 'Avaluador'])->get();

        // También pasar la lista de profesionales del centro para el select en la vista
        $professionals = $this->professionalsInCenter()->get();

        return view('evaluation.evaluation', [
            'evaluations' => $evaluations,
            'professionals' => $professionals,
        ]);
    }
        /**
         * Show the form for creating a new resource.
         */
        public function create()
    {
        // Profesionales del centro
        $professionals = $this->professionalsInCenter()->get();

    // Profesional seleccionado si se llega desde su ficha (aceptamos 'from_profesional' o 'profesional')
    $selectedProfesional = request()->query('from_profesional', request()->query('profesional', null));

    // Bloquear el select si viene desde la ficha de un profesional
    $lockSelect = $selectedProfesional !== null;

        // Inicializar oldValues vacío para la vista
        $oldValues = [];
        for ($i = 1; $i <= 20; $i++) {
            $oldValues['pregunta' . $i] = old('pregunta' . $i, null);
        }

        // IMPORTANTE: siempre enviar evaluation = null para evitar errores en la vista
        $evaluation = null;

        return view('evaluation.evaluation', [
            'professionals' => $professionals,
            'selectedProfesional' => $selectedProfesional,
            'lockSelect' => $lockSelect,
            'oldValues' => $oldValues,
            'evaluation' => $evaluation,
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

        // Redirigir a la ficha del profesional si venimos desde ella
        $returnTo = $request->input('return_to_profesional') ?: $request->input('id_profesional');
        if ($returnTo) {
            return redirect()->route('profesional.show', $returnTo)
                ->with('success', 'Avaluació guardada correctament.');
        }

        return redirect()->route('menu')
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

    public function edit($id)
    {
        // Obtener la evaluación
        $evaluation = Evaluation::findOrFail($id);

        // Obtener los profesionales del centro
        $professionals = Profesional::where('id_center', auth()->user()->id_center)->get();

        // Preparar valores para el cuestionario
        $oldValues = [];
        for ($i = 1; $i <= 20; $i++) {
            $oldValues['pregunta' . $i] = old('pregunta' . $i, $evaluation->{'q'.($i-1)});
        }

        return view('evaluation.formulario_editar', compact(
            'evaluation',
            'professionals',
            'oldValues'
        ));
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

        // Redirigir a la ficha del profesional si venimos desde ella
        $returnTo = $request->input('return_to_profesional') ?: $request->input('id_profesional');
        if ($returnTo) {
            return redirect()->route('profesional.show', $returnTo)
                ->with('success', 'Evaluació actualitzada correctament.');
        }

        return redirect()->route('menu')->with('success', 'Evaluació actualitzada correctament.');
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
