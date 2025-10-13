<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesional;
use App\Models\Center;

class ProfesionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $profesional = Profesional::get();
        return view("profesional.listar", 
            
            [
                "profesional" => $profesional
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $centre = Center::get();
        return view(
            "profesional.formulario_alta", 
            
            [
                "centre" => $centre
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Profesional::create([
            'nom' => $request->input('nom'),
            'cognom' => $request->input('cognom'),
            'telefon' => $request->input('telefon'),
            'email' => $request->input('email'),
            'adreça' => $request->input('adreça'),
            'actiu' => $request->input('actiu'),
            'id_center' => $request->input('id_center')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(profesional $profesional)
    {
        $centre = Center::get();
                return view(
            "profesional.formulario_editar",
            [
                'profesional' => $profesional,
                'nom' => $profesional->nom,
                'cognom' => $profesional->cognom,
                'telefon' => $profesional->telefon,
                'email' => $profesional->email,
                'adreça' => $profesional->adreça,
                'id_center' => $profesional->id_center,
                'centre' => $centre,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesional $profesional)
    {
        {
        //Obtiene todos los campos del formulario.
        // Laravel usará solo los que estén permitidos en $fillable del modelo.


        $profesional->update($request->all());

        return redirect()->route('menu');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesional $profesional)
    {
        $profesional->estat = false;
        $profesional->save();
        return redirect()->route('profesional.index');
    }
    public function active (Profesional $profesional)
    {
        $profesional->estat = true;
        $profesional->save();
        return redirect()->route('profesional.index');
    }
}
