<?php

namespace App\Traits;

use App\Models\Profesional;
use App\Models\Projectes_comissions;

trait CenterFilterable
{
    /**
     * Get the current user's center ID from session.
     */
    public function currentCenterId(): int
    {
        return session('id_center');
    }

    /**
     * Filter professionals by the current center.
     */
    public function professionalsInCenter()
    {
        return Profesional::where('id_center', $this->currentCenterId());
    }

    public function projectsInCenter()
    {
        return Projectes_comissions::where('centre_id', $this->currentCenterId());
    }

    /**
     * Validation rule to ensure a professional belongs to the current center.
     */
    public function professionalRule(): \Closure
    {
        $idCenter = $this->currentCenterId();

        return function($attr, $value, $fail) use ($idCenter) {
            if (!Profesional::where('id', $value)->where('id_center', $idCenter)->exists()) {
                $fail('El professional seleccionat no pertany al teu centre.');
            }
        };
    }
}
