<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Center;
use App\Models\Profesional;
use Illuminate\Http\Request;
use App\Traits\Activable;

class TrainingController extends Controller
{
    use Activable;

    public function index()
    {
        $trainings = Training::with('center')->get();

        return view('training.lista', [
            'trainings' => $trainings
        ]);
    }

    public function create()
    {
        $centers = Center::all();
        
        $professionals = Profesional::all();

        return view('training.alta_formulari', [
            'centers' => $centers,
            'professionals' => $professionals
        ]);
    }

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

        // Guardar relación con profesionales
        if (!empty($validated['professionals'])) {
            $training->professionals()->sync($validated['professionals']);
        }

        // Guardar archivo adjunto
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $path = $file->store('documents', 'public');
            $training->document = $path;
            $training->save();
        }

        return redirect()->route('trainings.index')
                         ->with('success', 'Curs creat correctament.');
    }

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
        ]);

        $training->update($validated);

        return redirect()->route('trainings.index')
                         ->with('success', 'Curs actualitzat correctament.');
    }

    public function active(Training $training)
    {
        return $this->toggleActive($training, true, 'trainings.index');
    }

    public function destroy(Training $training)
    {
        return $this->toggleActive($training, false, 'trainings.index');
    }
}
