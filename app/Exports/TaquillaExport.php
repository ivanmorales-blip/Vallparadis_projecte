<?php

namespace App\Exports;

use App\Models\Profesional;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TaquillaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Profesional::all()->map(function($profesional) {
            return [
                'nom' => $profesional->nom,
                'cognom' => $profesional->cognom,
                'taquilla' => $profesional->taquilla,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Cognom',
            'Taquilla',
        ];
    }
}
