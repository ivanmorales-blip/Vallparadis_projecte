<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesional;
use App\Models\Center;
use App\Models\Evaluation;
use App\Traits\Activable;
use App\Traits\CenterFilterable;

class ProfesionalController extends Controller
{
    use Activable, CenterFilterable;

    public function index()
    {
        $profesional = $this->professionalsInCenter()->get();
        return view('profesional.listar', [
            'profesional' => $profesional
        ]);
    }

    public function create()
    {   
        $centres = Center::all();
        return view('profesional.formulario_alta', [
            'centre' => $centres
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'cognom' => 'required|string|max:255',
            'telefon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'adreça' => 'nullable|string|max:255',
            'estat' => 'required|boolean',
            'id_center' => 'required|exists:center,id',
            'taquilla' => 'nullable|string|max:50',
            'talla_samarreta' => 'nullable|string|max:10',
            'talla_pantalons' => 'nullable|string|max:10',
            'talla_sabates' => 'nullable|string|max:10',
        ]);

        $validated['data_renovacio'] = now();

        Profesional::create($validated);

        return redirect()->route('menu');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesional $profesional)
    {
        $profesional->load(['center', 'trackings', 'evaluations']);
        return view('profesional.show', ['profesional' => $profesional]);
    }
    
    public function edit(Profesional $profesional)
    {
        $centres = Center::all();
        return view('profesional.formulario_editar', [
            'profesional' => $profesional,
            'nom' => $profesional->nom,
            'cognom' => $profesional->cognom,
            'telefon' => $profesional->telefon,
            'email' => $profesional->email,
            'taquilla' => $profesional->taquilla,
            'adreça' => $profesional->adreça,
            'id_center' => $profesional->id_center,
            'centre' => $centres,
            'talla_samarreta'=> $profesional->talla_samarreta,
            'talla_pantalons'=> $profesional->talla_pantalons,
            'talla_sabates'=> $profesional->talla_sabates,
        ]);
    }

    public function update(Request $request, Profesional $profesional)
    {
        {
        //Obtiene todos los campos del formulario.
        // Laravel usará solo los que estén permitidos en $fillable del modelo.
        $profesional->update($request->all());

        return redirect()->route('menu');
        }
    }

    public function active(Profesional $profesional)
    {
        if ($profesional->estat== 1){
            return $this->toggleActive($profesional, false, 'profesional.index');
        }
        else{
            return $this->toggleActive($profesional, true, 'profesional.index');
        }
    }

}
