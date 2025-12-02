<?php

namespace App\Http\Controllers;

use App\Models\Documents_management;
use App\Models\Profesional;
use App\Models\Center;
use Illuminate\Http\Request;
use App\Traits\Activable;
use App\Traits\CenterFilterable;
use Illuminate\Support\Facades\Storage;

class DocumentacioController extends Controller
{
    use Activable, CenterFilterable;

    public function index()
    {
        $centerId = $this->currentCenterId();

        $documentacio = Documents_management::where('centre_id', $centerId)->get();

        return view('documentacio.listar', [
            'document' => $documentacio
        ]);
    }

    public function create()
    {   
        $centerId = $this->currentCenterId();
        $center = Center::where('id', $centerId)->get();
        $profesional = $this->professionalsInCenter()->get();
        return view('documentacio.formulario_alta', [
            'profesional' => $profesional,
            'center' => $center
        ]);
    }

   public function store(Request $request)
    {

    $validated = $request->validate([
        'tipus' => 'required|string|max:255',
        'data' => 'required|date',
        'descripcio' => 'nullable|string',
        'professional_id' => 'required|exists:profesional,id',
        'centre_id' => 'required|exists:center,id',
        'document' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg',

    ]);

    if ($request->hasFile('document')) {
        $path = $request->file('document')->store('documents', 'public');
        $validated['arxiu'] = $path; 
    }

    $validated['estat'] = true;

    $document = Documents_management::create([
        'tipus' => $validated['tipus'],
        'data' => $validated['data'],
        'descripcio' => $validated['descripcio'] ?? null,
        'professional_id' => $validated['professional_id'],
        'centre_id' => $validated['centre_id'],
        'arxiu' => $validated['arxiu'],
        'estat' => $validated['estat'],
    ]);

    return redirect()->route('documentacio.index')
        ->with('success', 'Document guardat correctament.');
    }


    public function show(Documents_management $documentacio)
    {
        return view('documentacio.show', [
            'document' => $documentacio
        ]);
    }

    
    public function edit(Documents_management $documentacio)
    {
        $centerId = $this->currentCenterId();
        $center = Center::findOrFail($centerId);
        $profesional = $this->professionalsInCenter()->get();

        return view('documentacio.formulario_editar', [
            'document' => $documentacio,
            'profesional' => $profesional,
            'center' => $center
        ]);
    }


    public function update(Request $request, Documents_management $documentacio)
        {
            // Validate fields
            $validated = $request->validate([
                'tipus' => 'required|string|max:255',
                'data' => 'required|date',
                'descripcio' => 'required|string',
                'professional_id' => 'required|exists:profesional,id',
                'centre_id' => 'required|exists:center,id',
                'document' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg',
            ]);

            // Update simple fields (does NOT touch arxiu)
            $documentacio->tipus = $validated['tipus'];
            $documentacio->data = $validated['data'];
            $documentacio->descripcio = $validated['descripcio'];
            $documentacio->professional_id = $validated['professional_id'];
            $documentacio->centre_id = $validated['centre_id'];

            if ($request->hasFile('document')) {
                if ($documentacio->arxiu && Storage::disk('public')->exists($documentacio->arxiu)) {
                    Storage::disk('public')->delete($documentacio->arxiu);
                }

                $documentacio->arxiu = $request->file('document')->store('documents', 'public');
            }

            $documentacio->save();
            return redirect()->route('documentacio.index')
                ->with('success', 'Document actualitzat correctament.');
        }



    public function active(Documents_management $documentacio)
    {
        // $document is the existing record
        $documentacio->estat = !$documentacio->estat;
        $documentacio->save();

        return redirect()->route('documentacio.index')
            ->with('success', 'Document status updated correctly.');
    }
 
}