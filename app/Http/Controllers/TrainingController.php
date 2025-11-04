<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Center;
use App\Models\Profesional;
use Illuminate\Http\Request;
use App\Traits\Activable;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    use Activable;

    /**
     * Mostra el llistat de cursos.
     */
    public function index()
    {
        // Incloem relació amb centres per evitar N+1
        $trainings = Training::with('center')->get();

        return view('training.lista', [
            'trainings' => $trainings
        ]);
    }

    /**
     * Mostra el formulari per crear un nou curs.
     */
    public function create()
    {
        $centers = Center::all();
        $professionals = Profesional::all();

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
            'formador' => ['required', 'string', 'max:255'],
            'id_center' => ['nullable', 'exists:center,id'],
            'estat' => ['required', 'boolean'],
            'professionals' => ['nullable', 'array'],
            'professionals.*' => ['exists:profesional,id'], 
            'document' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
        ]);

        $training = Training::create($validated);

        // 🔗 Guardar relación con profesionales
        if (!empty($validated['professionals'])) {
            $training->professionals()->sync($validated['professionals']);
        }

        // 📄 Guardar archivo adjunto
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('documents', 'public');
            $training->update(['document' => $path]);
        }

        return redirect()->route('trainings.index')
                         ->with('success', 'Curs creat correctament.');
    }

    /**
     * Mostra el formulari per editar un curs existent.
     */
    public function edit(Training $training)
    {
        $centers = Center::all();
        $professionals = Profesional::all();

        return view('training.editar', [
            'training' => $training,
            'centers' => $centers,
            'professionals' => $professionals
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
            'document' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
        ]);

        // 📄 Si se sube un nuevo documento, reemplazamos el anterior
        if ($request->hasFile('document')) {
            if ($training->document && Storage::disk('public')->exists($training->document)) {
                Storage::disk('public')->delete($training->document);
            }
            $validated['document'] = $request->file('document')->store('documents', 'public');
        }

        $training->update($validated);

        return redirect()->route('trainings.index')
                         ->with('success', 'Curs actualitzat correctament.');
    }

    /**
     * Activa un curs (AJAX o normal).
     */
    public function active(Training $training)
    {
        return $this->toggleActive($training, true, 'trainings.index');
    }

    /**
     * Desactiva un curs (AJAX o normal).
     */
    public function destroy(Training $training)
    {
        return $this->toggleActive($training, false, 'trainings.index');
    }

    /**
     * NUEVA FUNCIÓN: mostrar los detalles de un curso.
     * (para poder hacer clic desde el listado y ver más información)
     */
    public function show(Training $training)
    {
        return view('training.mostrar', compact('training'));
    }
    public function addProfessionals(Training $training)
    {
    $assignedProfessionals = $training->professionals;
    $availableProfessionals = \App\Models\Profesional::whereNotIn('id', $assignedProfessionals->pluck('id'))->get();

    return view('training.afegir_professionals', compact('training', 'assignedProfessionals', 'availableProfessionals'));
    }

    public function updateProfessionals(Request $request, Training $training)
    {
        $request->validate([
            'professionals' => 'array',
            'professionals.*' => 'exists:profesional,id',
        ]);

        $training->professionals()->sync($request->professionals ?? []);

        return response()->json(['success' => true]);
    }
}
