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
     * Mostrar listado de accidentabilitats
     */
    public function index(Request $request)
    {
        $query = Accidentabilitat::query();

        if ($request->filled('tipus')) {
            $query->where('tipus', $request->tipus);
        }

        if ($request->filled('id_profesional')) {
            $query->where('id_profesional', $request->id_profesional);
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
     * Formulari alta accidentabilitat
     */
    public function create()
    {
        $professionals = Profesional::all();

        return view('accidentabilitat.alta_accidentabilitat', compact('professionals'));
    }

    /**
     * Guardar accidentabilitat
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipus' => 'required|in:sense_baixa,amb_baixa',
            'data' => 'required|date',
            'context' => 'required|string',
            'descripcio' => 'required|string',
            'id_profesional' => 'required|exists:profesional,id',
            'durada' => 'nullable|string|max:255',

        ]);

        $accident = Accidentabilitat::create($validated);

        return redirect()
            ->route('accidentabilitat.index')
            ->with('success', 'Accidentabilitat creada correctament');
    }

    /**
     * Mostrar detalle de un accidente
     */
    public function show($id)
    {
        $accident = Accidentabilitat::findOrFail($id);

        return view('accidentabilitat.show', compact('accident'));
    }

    /**
     * Formulari edición
     */
    public function edit($id)
    {
        $accident = Accidentabilitat::findOrFail($id);
        $professionals = Profesional::all();

        return view('accidentabilitat.formulario_editar', compact('accident', 'professionals'));
    }

    /**
     * Actualizar accidente
     */
    public function update(Request $request, $id)
    {
        $accident = Accidentabilitat::findOrFail($id);

        $validated = $request->validate([
            'tipus' => 'required|in:sense_baixa,amb_baixa',
            'data' => 'required|date',
            'context' => 'required|string',
            'descripcio' => 'required|string',
            'id_profesional' => 'required|exists:profesional,id',
            'durada' => 'nullable|string|max:255',

        ]);

        $accident->update($validated);

        return redirect()
            ->route('accidentabilitat.index')
            ->with('success', 'Accidentabilitat actualitzada correctament');
    }

    /**
     * Eliminar accidente
     */
    public function destroy($id)
    {
        $accident = Accidentabilitat::findOrFail($id);
        $accident->delete();

        return redirect()
            ->route('accidentabilitat.index')
            ->with('success', 'Accidentabilitat eliminada correctament');
    }
}
