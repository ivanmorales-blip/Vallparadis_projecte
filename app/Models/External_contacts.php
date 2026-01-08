<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class External_contacts extends Model
{
    protected $table = 'external_contacts';

    protected $fillable = [
        'centre_id',
        'tipus_servei',
        'empresa_departament',
        'responsable',
        'telefon',
        'correu',
        'observacions',
        'actiu',
    ];
}
