<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use App\Models\Profesional;
use Illuminate\Http\Request;
use App\Traits\Activable;
use App\Traits\CenterFilterable;
use Illuminate\Support\Facades\Storage;

class DocumentacioprofesionalController extends Controller
{
    use Activable, CenterFilterable;

        public function create($profesional)
    {
        return view('documentacioprofesional.alta', [
            'id_profesional' => $profesional,
        ]);
    }



   public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:255',
            'data'           => 'required|date',
            'document'       => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg',
            'id_profesional' => 'required|exists:profesional,id',
        ]);

        if ($request->hasFile('document')) {
            $validated['fitxer'] = $request
                ->file('document')
                ->store('documents', 'public');
        }

        Documentation::create([
            'nom'            => $validated['nom'],
            'data'           => $validated['data'],
            'fitxer'         => $validated['fitxer'],
            'id_profesional' => $validated['id_profesional'],
        ]);

        return redirect()
            ->route('profesional.show', ['profesional' => $validated['id_profesional']])
            ->with('success', 'Document guardat correctament.');

    }

    /**
     * Display the specified document.
     */
    public function show(Documentation $documentacio)
    {
        return view('documentacioprofesional.show', [
            'document' => $documentacio,
        ]);
    }

    /**
     * Show the form for editing the specified document.
     */
    public function edit(Documentation $documentacio)
    {
        return view('documentacioprofesional.formulario_editar', [
            'documentacio' => $documentacio,
        ]);
    }

    /**
     * Update the specified document.
     */
    public function update(Request $request, Documentation $documentacio)
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:255',
            'data'           => 'required|date',
            'document'       => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg',
            'id_profesional' => 'required|exists:profesional,id',
        ]);

        // Update basic fields
        $documentacio->update([
            'nom'            => $validated['nom'],
            'data'           => $validated['data'],
            'id_profesional' => $validated['id_profesional'],
        ]);

        // Replace file if a new one is uploaded
        if ($request->hasFile('document')) {
            if (
                $documentacio->fitxer &&
                Storage::disk('public')->exists($documentacio->fitxer)
            ) {
                Storage::disk('public')->delete($documentacio->fitxer);
            }

            $documentacio->update([
                'fitxer' => $request
                    ->file('document')
                    ->store('documents', 'public'),
            ]);
        }

        return redirect()
            ->route('menu')
            ->with('success', 'Document actualitzat correctament.');
    }



    public function active(Documentation $documentacio)
    {
        // $document is the existing record
        $documentacio->estat = !$documentacio->estat;
        $documentacio->save();

        return redirect()->route('documentacio.index')
            ->with('success', 'Document status updated correctly.');
    }
 
}