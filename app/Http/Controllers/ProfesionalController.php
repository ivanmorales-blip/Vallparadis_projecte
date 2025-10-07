<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesional;
class ProfesionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        //$centres;
        return view("profesional.formulario_alta_profesional");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        enter::create([
            'nom' => $request->input('nom'),
            'cognoms' => $request->input('cognoms'),
            'telefon' => $request->input('telefon'),
            'email' => $request->input('correu'),
            'adreça' => $request->input('adreça'),
            'estat' => $request->input('estat'),
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
