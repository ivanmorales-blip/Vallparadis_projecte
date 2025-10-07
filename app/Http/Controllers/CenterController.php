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
        //
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
            'adreça' => $request->input('adresa'),
            'telefon' => $request->input('telefon'),
            'email' => $request->input('mail'),
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
