<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Center;
use Illuminate\Http\Request;
use App\Traits\Activable;
use App\Traits\CenterFilterable;
use Illuminate\Support\Facades\Storage;

class MaintenanceController extends Controller
{
    use Activable, CenterFilterable;

    public function index()
    {
        $centerId = $this->currentCenterId();

        $manteniment = Maintenance::where('centre_id', $centerId)->get();

        return view('manteniment.listar', [
            'maintenance' => $manteniment
        ]);
    }

    public function create()
    {   
        $centerId = $this->currentCenterId();
        $center = Center::find($centerId); // devuelve un único modelo en vez de colección

        if (!$center) {
            abort(404, 'Centre no trobat');
        }

        return view('manteniment.formulario_alta', [
            'center' => $center
        ]);
    }


   public function store(Request $request)
    {

        $validated = $request->validate([
        'data_obertura' => 'required|date',
        'descripcio' => 'nullable|string',
        'centre_id' => 'required|exists:center,id',
        'documentacio' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg',
        'responsable' => 'required|string',
        ]);

        // Handle file upload
        $path = null;
        if ($request->hasFile('documentacio')) {
            $path = $request->file('documentacio')->store('documentacio', 'public');
        }

        $manteniment = Maintenance::create([
            'data_obertura' => $validated['data_obertura'],
            'descripcio' => $validated['descripcio'] ?? null,
            'centre_id' => $validated['centre_id'],
            'documentacio' => $path,           // save uploaded file path
            'responsable' => $validated['responsable'],
            'estat' => true,
        ]);


    return redirect()->route('manteniment.index')
        ->with('success', 'Manteniment guardat correctament.');
    }


    public function show(Maintenance $manteniment)
    {
        return view('manteniment.show', [
            'manteniment' => $manteniment
        ]);
    }

    
    public function edit(Maintenance $manteniment)
    {
        $centerId = $this->currentCenterId();
        $center = Center::findOrFail($centerId);

        return view('manteniment.formulario_editar', [
            'manteniment' => $manteniment,
            'center' => $center
        ]);
    }


    public function update(Request $request, Maintenance $manteniment)
        {
            // Validate fields
            $validated = $request->validate([
                'data_obertura' => 'required|date',
                'descripcio' => 'nullable|string',
                'documentacio' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg',
                'responsable' => 'required|string',
            ]);

            $manteniment->data_obertura = $validated['data_obertura'];
            $manteniment->descripcio = $validated['descripcio'];
            $manteniment->responsable= $validated['responsable'];

            if ($request->hasFile('documentacio')) {
                if ($manteniment->documentacio && Storage::disk('public')->exists($manteniment->documentacio)) {
                    Storage::disk('public')->delete($manteniment->documentacio);
                }

                $manteniment->documentacio = $request->file('documentacio')->store('documentacio', 'public');
            }

            $manteniment->save();
            return redirect()->route('manteniment.index')
                ->with('success', 'Manteniment actualitzat correctament.');
        }

    public function active(Maintenance $manteniment)
    {
        $manteniment->estat = !$manteniment->estat;
        $manteniment->save();

        return redirect()->route('manteniment.index');
    }   
}