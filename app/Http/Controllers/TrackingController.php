<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesional;
use App\Models\Tracking;
use App\Traits\Activable;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracking = Tracking::get();
        return view("tracking.listar", 
            
            [
                "tracking" => $tracking
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $profesional = Profesional::get();
        return view(
            "tracking.formulario_alta", 
            
            [
                "profesional" => $profesional
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Tracking::create([ 
            'tipus' => $request->input('tipus'),
            'data' => $request->input('data'),
            'tema' => $request->input('tema'),
            'comentari' => $request->input('comentari'), 
            'id_profesional' => $request->input('id_profesional'),
            'id_profesional_registrador' => $request->input('id_profesional_registrador'),
            'estat' => $request->input('estat'),
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
    public function edit(Tracking $tracking)
    {
        $profesional = Profesional::get();
                return view(
            "tracking.formulario_editar",
            [
                "profesional"=>$profesional,
                "tracking"=>$tracking
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tracking $tracking)
    {
        {
        //Obtiene todos los campos del formulario.
        // Laravel usará solo los que estén permitidos en $fillable del modelo.

        $tracking->update($request->all());

        return redirect()->route('menu');
        }
    }

    use Activable;

    public function active(Tracking $tracking)
    {
        return $this->toggleActive($tracking, true, 'tracking.index');
    }

    public function destroy(Tracking $tracking)
    {
        return $this->toggleActive($tracking, false, 'tracking.index');
    }

}