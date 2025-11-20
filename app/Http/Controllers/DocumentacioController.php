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
        $documentacio = Documents_management::with('centre_id')
            ->where('centre_id', $centerId)
            ->get();
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
            'data' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'professional_id' => 'required|exists:profesional,id',
            'centre_id' => 'required|exists:center,id',
            'document' => 'required|file|mimes:pdf,doc,docx',
            'estat' => 'required|boolean',
        ]);

        $document = Documents_management::create($validated);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('documents', 'public');
            $document->update(['document' => $path]);
        }

        return redirect()->route('documentacio.index')
        ->with('success', 'Documents guardats correctament.');
    }

    public function show(Documents_management $document)
    {
        return view('documentacio.mostrar', [
            'document' => $document
        ]);
    }

    
    public function edit(Documents_management $document)
    {
        $centerId = $this->currentCenterId();
        $center = Center::where('id', $centerId)->get();
        $profesional = $this->professionalsInCenter()->get();
        return view('documentacio.formulario_editar', [
            'document' => $document,
            'profesional' => $profesional,
            'center' => $center
        ]);
    }

    public function update(Request $request, Documents_management $document)
    {
        {
        //Obtiene todos los campos del formulario.
        // Laravel usará solo los que estén permitidos en $fillable del modelo.
        $document->update($request->all());

        return redirect()->route('documentacio.index')
        ->with('success', 'Document actualitzat correctament.');
        }
    }

    public function active(Documents_management $document)
    {
        return $this->toggleActive($document, true, 'documentacio.index');
    }

    public function destroy(Documents_management $document)
    {
        return $this->toggleActive($document, false, 'documentacio.index');
    }
}