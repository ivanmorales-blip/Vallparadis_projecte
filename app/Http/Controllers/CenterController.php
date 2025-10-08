<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
   {
        //Obtenemos todos los centros de la base de datos y se los pasamos a la vista listar
        $centers = Center::get();
        
        return view(
            //Nombre de la vista que vamos a cargar
            "centers.listar",
            [
                //Se le pasa como parámetro el listado de centros
                "centers" => $centers
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("centers.formulario_alta");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Center::create([
            'nom' => $request->input('nom'),
            'adreça' => $request->input('adreça'),
            'telefon' => $request->input('telefon'),
            'email' => $request->input('mail'),
        ]);
        return redirect()->route('menu');
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
    public function edit(Center $center)
    {
        return view(
            "centers.formulario_editar",
            [
                'center' => $center,
                'nom' => $center->nom,
                'adreça' => $center->adreça,
                'telefon' => $center->telefon,
                'email' => $center->email,
            ]
        );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Center $center)
    {
        {
        //Obtiene todos los campos del formulario.
        // Laravel usará solo los que estén permitidos en $fillable del modelo.


        $center->update($request->all());

        return redirect()->route('menu');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $center = Center::findOrFail($id);
        $center->activo = false;
        $center->save();
        return redirect()->route('centers.index');
    }
    public function active (Center $center)
    {
        $center->activo = true;
        $center->save();
        return redirect()->route('centers.index');
    }
}
