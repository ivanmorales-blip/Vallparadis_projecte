<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\Profesional;
use App\Traits\Activable;
use App\Traits\CenterFilterable;

class TrackingController extends Controller
{
    use Activable, CenterFilterable;

    public function index()
    {
        $trackings = Tracking::with('profesional')
            ->whereHas('profesional', function($query) {
                $query->where('id_center', session('id_center'));
            })
            ->get();

        return view('tracking.listar', [
            'tracking' => $trackings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $professionals = $this->professionalsInCenter()->get();

        // Obtenemos el ID del profesional desde query string
        $selectedProfesional = request()->query('profesional', null);

        return view('tracking.formulario_alta', [
            'professionals' => $professionals,
            'selectedProfesional' => $selectedProfesional,
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'observacions' => 'nullable|string',
            'id_profesional' => 'required|exists:profesional,id',
            'tipus' => 'required|string',
            'tema' => 'required|string',
            'comentari' => 'required|string',
            'id_profesional_registrador' => 'required|exists:profesional,id',
        ]);

        Tracking::create($validated);

        return redirect()->route('tracking.index');
    }

    /**
     * Display the specified resource.
     */
   public function show(Tracking $tracking)
    {
        $tracking->load(['profesional', 'registrador']);
        return view('tracking.show', compact('tracking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tracking $tracking)
    {
        $profesional = $this->professionalsInCenter()->get();
        return view('tracking.formulario_editar', [
            'tracking' => $tracking,
            'data' => $tracking->data,
            'observacions' => $tracking->observacions,
            'id_profesional' => $tracking->id_profesional,
            'profesional' => $profesional
        ]);
    }

    public function update(Request $request, Tracking $tracking)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'observacions' => 'nullable|string',
            'id_profesional' => 'required|exists:profesional,id',
            'id_profesional_registrador' => 'required|exists:profesional,id',
            'tipus' => 'required|string',
            'tema' => 'required|string',
            'comentari' => 'required|string',
        ]);


        $tracking->update($validated);

        return redirect()->route('tracking.index');
    }

    public function active(Tracking $tracking)
    {
        return $this->toggleActive($tracking, true, 'tracking.index');
    }

    public function destroy(Tracking $tracking)
    {
        return $this->toggleActive($tracking, false, 'tracking.index');
    }
}
