<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Center;
use Illuminate\Http\Request;
use App\Traits\Activable;
use App\Traits\CenterFilterable;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    use Activable, CenterFilterable;

    /**
     * Mostra el llistat de cursos.
     */
    public function index()
    {
        $centerId = $this->currentCenterId();
        $trainings = Training::with('center')
            ->where('id_center', $centerId)
            ->get();

        return view('training.lista', [
            'trainings' => $trainings
        ]);
    }

    /**
     * Mostra el formulari per crear un nou curs.
     */
    public function create()
    {
        $centerId = $this->currentCenterId();
        $centers = Center::where('id', $centerId)->get();
        $professionals = $this->professionalsInCenter()->get();

        return view('training.alta_formulari', [
            'centers' => $centers,
            'professionals' => $professionals
        ]);
    }

    /**
     * Desa un nou curs a la base de dades.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_curs' => ['required', 'string', 'max:255'],
            'data_inici' => ['required', 'date'],
            'data_fi' => ['required', 'date', 'after_or_equal:data_inici'],
            'hores' => ['required', 'numeric', 'min:1'],
            'objectiu' => ['nullable', 'string'],
            'descripcio' => ['nullable', 'string'],
            'formador' => ['required', 'exists:profesional,id'], // main trainer
            'id_center' => ['nullable', 'exists:center,id'], // match DB column
            'estat' => ['required', 'boolean'],
            'professionals' => ['nullable', 'array'], // extra assigned professionals
            'professionals.*' => [$this->professionalRule()],
            'training' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
        ]);

        // Fix column names to match your DB
        $trainingData = $validated;
        $trainingData['center_id'] = $validated['id_center'] ?? null; // if your DB column is center_id

        $training = Training::create($trainingData);

        // Sync multiple professionals (assigned)
        if (!empty($validated['professionals'])) {
            $training->professionals()->sync($validated['professionals']);
        }

        // Handle file upload
        if ($request->hasFile('training')) {
            $path = $request->file('training')->store('trainings', 'public');
            $training->update(['training' => $path]);
        }

        return redirect()->route('trainings.index')
                        ->with('success', 'Curs creat correctament.');
    }


    /**
     * Mostra el formulari per editar un curs existent.
     */
    public function edit(Training $training)
    {
        $centerId = $this->currentCenterId();
        $centers = Center::where('id', $centerId)->get();
        $professionals = $this->professionalsInCenter()->get();

        return view('training.editar', [
            'training' => $training,
            'centers' => $centers,
            'profesional' => $professionals
        ]);
    }

    /**
     * Actualitza un curs existent.
     */
    public function update(Request $request, Training $training)
    {
        $validated = $request->validate([
            'nom_curs' => ['required', 'string', 'max:255'],
            'data_inici' => ['required', 'date'],
            'data_fi' => ['required', 'date', 'after_or_equal:data_inici'],
            'hores' => ['required', 'numeric', 'min:1'],
            'objectiu' => ['nullable', 'string'],
            'descripcio' => ['nullable', 'string'],
            'formador' => ['required', 'string', 'max:255'],
            'id_center' => ['nullable', 'exists:center,id'],
            'estat' => ['required', 'boolean'],
            'training' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
        ]);

        if ($request->hasFile('training')) {
            if ($training->training && Storage::disk('public')->exists($training->training)) {
                Storage::disk('public')->delete($training->training);
            }
            $validated['training'] = $request->file('training')->store('trainings', 'public');
        }

        $training->update($validated);

        return redirect()->route('trainings.index')
                         ->with('success', 'Curs actualitzat correctament.');
    }

    /**
     * Activa un curs.
     */
    public function active(Training $training)
    {
        if ($training->estat== 1){
            return $this->toggleActive($training, false, 'trainings.index');
        }
        else{
            return $this->toggleActive($training, true, 'trainings.index');
        }
    }

    /**
     * Desactiva un curs.
     */
    public function destroy(Training $training)
    {
        return $this->toggleActive($training, false, 'trainings.index');
    }

    /**
     * Mostrar detalles de un curso.
     */
    public function show(Training $training)
    {
        return view('training.mostrar', [
            'training' => $training
        ]);
    }

    public function addProfessionals(Training $training)
    {
        $assignedProfessionals = $training->professionals;
        $availableProfessionals = $this->professionalsInCenter()
            ->whereNotIn('id', $assignedProfessionals->pluck('id'))
            ->get();

        return view('training.afegir_professionals', [
            'training' => $training,
            'assignedProfessionals' => $assignedProfessionals,
            'availableProfessionals' => $availableProfessionals
        ]);
    }

    public function updateProfessionals(Request $request, Training $training)
    {
        $request->validate([
            'professionals' => 'array',
            'professionals.*' => [$this->professionalRule()],
        ]);

        $training->professionals()->sync($request->professionals ?? []);

        return response()->json(['success' => true]);
    }
}
