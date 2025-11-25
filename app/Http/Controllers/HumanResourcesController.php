<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\TemaPendent;
use App\Models\Seguiment;
use App\Models\Profesional;
use App\Models\User;
use Illuminate\Http\Request;

class HumanResourcesController extends Controller
{
    /**
     * Lista todos los registros de un centro
     */
    public function index($centre_id = null)
    {
        $centres = Center::all();
        $centre_id = $centre_id ?? $centres->first()?->id;

        // Cargar relaciones para evitar campos vacíos
        $pendents = TemaPendent::with(['afectat', 'registra', 'derivat'])
            ->where('centre_id', $centre_id)
            ->get();

        $seguiments = Seguiment::with('professional') // aquí la relación debe llamarse 'professional'
            ->where('centre_id', $centre_id)
            ->get();

        return view('rrhh.lista', compact('centres', 'centre_id', 'pendents', 'seguiments'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create($centre_id, $type)
    {
        return view('rrhh.human_resources', compact('centre_id', 'type'));
    }

    /**
     * Guardar registro
     */
    public function store(Request $request, $centre_id)
    {
        $tipus = $request->input('tipus');

        if ($tipus === 'pendent') {

            $validated = $request->validate([
                'data_obertura' => 'required|date',
                'id_professional_afectat' => 'required|exists:profesional,id',
                'id_registre' => 'required|exists:users,id',
                'id_derivat' => 'nullable|exists:profesional,id',
                'descripcio' => 'required|string',
            ]);

            TemaPendent::create([
                'centre_id' => $centre_id,
                'data_obertura' => $validated['data_obertura'],
                'professional_afectat' => $validated['id_professional_afectat'],
                'professional_registra' => $validated['id_registre'],
                'derivat_a' => $validated['id_derivat'] ?? null,
                'descripcio' => $validated['descripcio'],
                'document' => $request->file('document')
                                ? $request->file('document')->store('documents')
                                : null,
            ]);

        } elseif ($tipus === 'seguiment') {

            $validated = $request->validate([
                'data' => 'required|date',
                'id_professional' => 'required|exists:profesional,id',
                'descripcio' => 'required|string',
            ]);

            Seguiment::create([
                'centre_id' => $centre_id,
                'data' => $validated['data'],
                'id_professional' => $validated['id_professional'], // nombre correcto del campo en tabla
                'descripcio' => $validated['descripcio'],
            ]);
        }

        return redirect()->route('human_resources.index', $centre_id)
                         ->with('success', 'Registre creat correctament');
    }

    /**
     * Cambiar estado de Tema Pendent
     */
    public function toggleTema($temaId)
{
    $tema = TemaPendent::findOrFail($temaId); // buscar tema
    $tema->completed = !$tema->completed; // ejemplo de toggle
    $tema->save();

    return redirect()->back()->with('success', 'Tema pendent actualizado');
}

    public function active(Seguiment $seguiment)
{
    $seguiment->actiu = !$seguiment->actiu; // Cambiar de true a false o viceversa
    $seguiment->save();

    return redirect()->back()->with('success', 'Estat actualitzat correctament.');
}

public function activeTema(TemaPendent $tema)
{
    $tema->actiu = !$tema->actiu; // Cambiar de true a false o viceversa
    $tema->save();

    return redirect()->back()->with('success', 'Estat actualitzat correctament.');
}
}