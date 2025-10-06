<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Projectes_comissionsController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Projectes_comissions::create([
            'nom' => $request->input('nom'),
            'tipus' => $request->input('tipus'),
            'data_inici' => $request->input('data_inici'),
            'profesional_id' => $request->input('profesional_id'),
            'descripcio' => $request->input('descripcio'),
            'observacions' => $request->input('observacions'),
            'centre_id' => $request->input('centre_id'),
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
