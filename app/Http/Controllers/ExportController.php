<?php

namespace App\Http\Controllers;

use App\Exports\TaquillaExport; 
use App\Exports\UniformExport;   
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    // Export Taquilla data
    public function exportTaquilla()
    {
        return Excel::download(new TaquillaExport, 'taquilla.xlsx');
    }

    // Export Uniform data
    public function exportUniform()
    {
        return Excel::download(new UniformExport, 'uniforms.xlsx');
    }
}
