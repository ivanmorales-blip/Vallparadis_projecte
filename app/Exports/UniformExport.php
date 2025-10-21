<?php

namespace App\Exports;

use App\Models\Profesional;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UniformExport implements FromCollection, WithHeadings
{
        
    public function collection()
    {
        return Profesional::all()->map(function($profesional) {
            return [
                'nom' => $profesional->nom,
                'cognom' => $profesional->cognom,
                'talla_samarreta' => $profesional->talla_samarreta,
                'talla_pantalons' => $profesional->talla_pantalons,
                'talla_sabates' => $profesional->talla_sabates,
                'data_renovacio' => $profesional->data_renovacio ? $profesional->data_renovacio->format('Y-m-d') : '',
            ];
        });
    }


    public function headings(): array
    {
        return [
            'Nom',
            'Cognom',
            'Talla Samarreta',
            'Talla Pantalons',
            'Talla Sabates',
            'Data Renovació uniforms',
        ];
    }
}
