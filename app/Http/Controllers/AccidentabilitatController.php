<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accidentabilitat;
use App\Models\Profesional;
use App\Models\Center;
use Illuminate\Support\Facades\Storage;

class AccidentabilitatController extends Controller
{
    /**
     * Llistat d'accidents
     */
    public function index(Request $request)
    {
        $query = Accidentabilitat::query();

        if ($request->filled('tipus')) {
            $query->where('tipus', $request->tipus);
        }

        if ($request->filled('centre_id')) {
            $query->where('centre_id', $request->centre_id);
        }

        if ($request->filled('estat')) {
            $query->where('estat', $request->estat);
        }

        if ($request->filled('data_inici') && $request->filled('data_fi')) {
            $query->whereBetween('data', [
                $request->data_inici,
                $request->data_fi
            ]);
        }

        $accidents = $query->orderBy('data', 'desc')->paginate(15);

        return view('accidentabilitat.llistat_accidentabilitat', compact('accidents'));
    }

    /**
     * Formulari alta accident
     */
    public function create()
    {
        $professionals = Profesional::all();
        $centres = Center::all();

        return view('accidentabilitat.alta_accidentabilitat', compact('professionals', 'centres'));
    }

    /**
     * Guardar accident
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipus' => 'required|in:sense_baixa,amb_baixa',
            'data_accident' => 'required|date',
            'context' => 'required|string',
            'descripcio' => 'required|string',
            'professional_id' => 'required|exists:profesional,id',
            'centre_id' => 'required|exists:centres,id',
            'durada_baixa' => 'nullable|date',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,png'
        ]);

        $accident = new Accidentabilitat();
        $accident->tipus = $validated['tipus'];
        $accident->data = $validated['data_accident'];
        $accident->context = $validated['context'];
        $accident->descripcio = $validated['descripcio'];
        $accident->durada = $validated['durada_baixa'] ?? null;
        $accident->centre_id = $validated['centre_id'];
        $accident->id_profesional = $validated['professional_id'];
        $accident->estat = $validated['tipus'] === 'amb_baixa' ? 'activa' : 'tancada';

        if ($request->hasFile('document')) {
            $accident->document = $request->file('document')
                ->store('accidents', 'public');
        }

        $accident->save();

        return redirect()
            ->route('accidentabilitat.index')
            ->with('success', 'Accident creat correctament');
    }

    /**
     * Veure fitxa accident
     */
    public function show($id)
    {
        $accident = Accidentabilitat::with('seguiments')->findOrFail($id);

        return view('accidentabilitat.show', compact('accident'));
    }

    /**
     * Formulari edició
     */
    public function edit($id)
    {
        $accident = Accidentabilitat::findOrFail($id);
        $professionals = Profesional::all();
        $centres = Center::all();

        return view('accidentabilitat.edit', compact('accident', 'professionals', 'centres'));
    }

    /**
     * Actualitzar accident
     */
    public function update(Request $request, $id)
    {
        $accident = Accidentabilitat::findOrFail($id);

        $validated = $request->validate([
            'tipus' => 'required|in:sense_baixa,amb_baixa',
            'data_accident' => 'required|date',
            'context' => 'required|string',
            'descripcio' => 'required|string',
            'durada_baixa' => 'nullable|date',
            'estat' => 'required|in:activa,tancada',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,png'
        ]);

        $accident->tipus = $validated['tipus'];
        $accident->data = $validated['data_accident'];
        $accident->context = $validated['context'];
        $accident->descripcio = $validated['descripcio'];
        $accident->durada = $validated['durada_baixa'] ?? null;
        $accident->estat = $validated['estat'];

        if ($request->hasFile('document')) {
            if ($accident->document) {
                Storage::disk('public')->delete($accident->document);
            }

            $accident->document = $request->file('document')
                ->store('accidents', 'public');
        }

        $accident->save();

        return redirect()
            ->route('accidentabilitat.index')
            ->with('success', 'Accident actualitzat correctament');
    }

    /**
     * Eliminar accident
     */
    public function destroy($id)
    {
        $accident = Accidentabilitat::findOrFail($id);

        if ($accident->document) {
            Storage::disk('public')->delete($accident->document);
        }

        $accident->delete();

        return redirect()
            ->route('accidentabilitat.index')
            ->with('success', 'Accident eliminat correctament');
    }
}
