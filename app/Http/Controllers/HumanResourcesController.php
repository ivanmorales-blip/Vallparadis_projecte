<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemaPendent;
use App\Models\Profesional;
use App\Models\User;
use App\Traits\CenterFilterable;

class HumanResourcesController extends Controller
{

    use CenterFilterable;
    /**
     * Mostrar todos los temes pendents de un centro.
     */
    public function index($centre_id)
    {

        $centerId = $this->currentCenterId();

        $temes_pendents = TemaPendent::where('centre_id', $centerId)->get();

        return view('rrhh.lista', compact('temes_pendents'));
    }

    /**
     * Mostrar un tema pendent específico.
     */
    public function show(TemaPendent $tema)
{
    // Cargamos todas las relaciones necesarias
    $tema->load([
        'profesional',            // Profesional afectado
        'professionalRegistra',   // Quien registró el tema
        'derivatA',               // Profesional al que se derivó

    ]);

    return view('rrhh.show', compact('tema'));
}


    /**
     * Formulario de creación.
     */
    public function create($centre_id)
    {
        $professionals = Profesional::all();
        $users = User::all();
        $type = 'pendent'; // identificar tipo de tema

        return view('rrhh.human_resources', compact('centre_id', 'type', 'professionals', 'users'));
    }

    /**
     * Guardar un nuevo tema pendent.
     */
    public function store(Request $request, $centre_id)
    {
        // Validación de datos
        $validated = $request->validate([
            'data_obertura' => 'required|date',
            'tema_pendent' => 'required|string',
            'professional_afectat' => 'required|exists:profesional,id',
            'professional_registra' => 'required|exists:users,id',
            'derivat_a' => 'nullable|exists:profesional,id',
            'descripcio' => 'required|string',
            'documentacio_adjunta' => 'nullable|file|max:10240',
        ]);

        // Procesar documento adjunto (solo 1 archivo, si quieres varios hay que ajustar)
        $documentPath = null;
        if ($request->hasFile('documentacio_adjunta')) {
            $documentPath = $request->file('documentacio_adjunta')->store('documents', 'public');
        }

        // Crear el registro en la base de datos
        $tema = TemaPendent::create([
            'centre_id' => $centre_id,
            'data_obertura' => $validated['data_obertura'],
            'tema_pendent' => $request->input('tema_pendent'),
            'professional_afectat' => $validated['professional_afectat'],
            'professional_registra' => $validated['professional_registra'],
            'derivat_a' => $validated['derivat_a'] ?? null,
            'descripcio' => $validated['descripcio'],
            'document' => $documentPath ? json_encode([$documentPath]) : null,
            'actiu' => true,
        ]);

        return redirect()->route('human_resources.index', $centre_id)
                         ->with('success', 'Tema pendent creat correctament.');
    }

    /**
     * Formulario de edición.
     */
    public function edit(TemaPendent $tema)
    {
        $professionals = Profesional::all();
        $users = User::all();
        $centre_id = $tema->centre_id;
        $type = 'pendent';

        return view('rrhh.formulario_editar', compact('tema', 'professionals', 'users', 'centre_id', 'type'));
    }

    /**
     * Actualizar un tema pendent existente.
     */
    public function update(Request $request, TemaPendent $tema)
    {
        $validated = $request->validate([
            'data_obertura' => 'required|date',
            'tema_pendent' => 'required|string',
            'professional_afectat' => 'required|exists:profesional,id',
            'professional_registra' => 'required|exists:users,id',
            'derivat_a' => 'nullable|exists:profesional,id',
            'descripcio' => 'required|string',
            'documentacio_adjunta' => 'nullable|file|max:10240',
        ]);

        // Procesar documento adjunto si se sube uno nuevo
        if ($request->hasFile('documentacio_adjunta')) {
            $tema->document = json_encode([$request->file('documentacio_adjunta')->store('documents', 'public')]);
        }

        // Actualizar el tema pendiente
        $tema->update([
            'data_obertura' => $validated['data_obertura'],
            'professional_afectat' => $validated['professional_afectat'],
            'professional_registra' => $validated['professional_registra'],
            'derivat_a' => $validated['derivat_a'] ?? null,
            'descripcio' => $validated['descripcio'],
            'actiu' => $tema->actiu,
            'document' => $tema->document,
        ]);

        return redirect()->route('human_resources.index', $tema->centre_id)
                         ->with('success', 'Tema pendent actualitzat correctament.');
    }

    /**
     * Activar / Desactivar un tema pendent.
     */
    public function toggleActive(TemaPendent $tema)
    {
        $tema->actiu = !$tema->actiu;
        $tema->save();

        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }
}
