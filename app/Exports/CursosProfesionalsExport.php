<?php

namespace App\Exports;

use App\Models\Training;
use App\Models\Profesional;
use App\Models\Center;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CursosProfesionalsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $trainings = Training::with(['professionals', 'center'])->get();

        return $trainings->map(function ($training) {
            $formadorIds = [];
            if (is_array($training->formador)) {
                $formadorIds = $training->formador;
            } elseif (is_string($training->formador)) {
                $formadorIds = array_filter(explode(',', $training->formador));
            }

            $formadors = Profesional::whereIn('id', $formadorIds)
                ->get(['nom', 'cognom'])
                ->map(fn($f) => "{$f->nom} {$f->cognom}")
                ->implode(', ');

            $professionals = $training->professionals->map(function ($p) {
                return "{$p->nom} {$p->cognom} ({$p->telefon})";
            })->implode(', ');

            $centerName = $training->center
                ? $training->center->nom
                : Center::where('id', $training->id_center)->value('nom');

            return [
                'Nom del curs' => $training->nom_curs,
                'Data Inici'   => $training->data_inici,
                'Data Fi'      => $training->data_fi,
                'Formadors'    => $formadors,
                'Hores'        => $training->hores,
                'Objectiu'     => $training->objectiu,
                'Centre'       => $centerName ?? '—',
                'Estat'        => $training->estat ? 'Actiu' : 'Inactiu',
                'Professionals' => $professionals,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nom del curs',
            'Data Inici',
            'Data Fi',
            'Formadors',
            'Hores',
            'Objectiu',
            'Centre',
            'Estat',
            'Professionals (Nom, Cognom, Telèfon)',
        ];
    }
}
