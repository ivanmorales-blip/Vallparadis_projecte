<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemaPendent;
use App\Models\Profesional;
use App\Models\User;

class HumanResourcesController extends Controller
{
    // Llistat de temes pendents
    public function index($centre_id)
    {
        $temes_pendents = TemaPendent::with(['profesional', 'professionalRegistra', 'derivatA'])
                                      ->where('centre_id', $centre_id)
                                      ->get();

        return view('rrhh.lista', compact('temes_pendents', 'centre_id'));
    }

    // Mostrar tema pendent
    public function show($id)
    {
        $tema = TemaPendent::with(['profesional', 'professionalRegistra', 'derivatA'])->findOrFail($id);
        return view('rrhh.show', compact('tema'));
    }

    // Formulari de creació
    public function create($centre_id)
{
    $type = 'pendent'; // si es fijo
    $professionals = Profesional::all();
    $users = User::all();

    return view('rrhh.human_resources', compact('centre_id', 'type', 'professionals', 'users'));
}


    // Guardar tema pendent
    public function store(Request $request, $centre_id)
{
    $pathsToFiles = [];

    if ($request->hasFile('documentacio_adjunta')) {
        foreach ($request->file('documentacio_adjunta') as $file) {
            $pathsToFiles[] = $file->store('documents', 'public');
        }
    }

    $tema = TemaPendent::create([
        'centre_id' => $centre_id,
        'data_obertura' => $request->data_obertura,
        'professional_afectat' => $request->professional_afectat,
        'professional_registra' => $request->professional_registra,
        'derivat_a' => $request->derivat_a,
        'descripcio' => $request->descripcio,
        'document' => json_encode($pathsToFiles),
        'actiu' => true,
    ]);

    return redirect()->route('human_resources.index', $centre_id);
}

    // Formulari d'edició
    public function edit(TemaPendent $tema)
    {
        $professionals = Profesional::all();
        $users = User::all();
        $centre_id = $tema->centre_id; 
        $type = 'pendent';
        return view('rrhh.formulario_editar', compact('tema', 'professionals', 'users', 'centre_id', 'type'));
    }

    // Actualitzar tema pendent
    public function update(Request $request, TemaPendent $tema)
    {
        $request->validate([
            'data_obertura' => 'required|date',
            'professional_afectat' => 'required|exists:profesional,id',
            'professional_registra' => 'required|exists:users,id',
            'derivat_a' => 'required|exists:profesional,id',
            'descripcio' => 'required|string',
            'documentacio_adjunta' => 'nullable|file|max:10240',
        ]);

        // Processar fitxer si existeix
       if ($request->hasFile('documentacio_adjunta')) {
        $tema->document = $request->file('documentacio_adjunta')->store('documents', 'public');
    }
    

        $tema->update([
        'data_obertura' => $request->data_obertura,
        'professional_afectat' => $request->professional_afectat,
        'professional_registra' => $request->professional_registra,
        'derivat_a' => $request->derivat_a,
        'descripcio' => $request->descripcio,
        'actiu' => $tema->actiu,
        'document' => $tema->document,
    ]);

        return redirect()->route('human_resources.index', $tema->centre_id);
    }

    // Activar / Desactivar tema
    public function toggleActive(TemaPendent $tema)
{
    $tema->actiu = !$tema->actiu; // invierte el estado
    $tema->save();

    return redirect()->back()->with('success', 'Estado actualizado correctamente.');
}


}
