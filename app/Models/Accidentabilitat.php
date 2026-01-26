<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accidentabilitat extends Model
{
    protected $table = 'accidentability';

    protected $fillable = [
        'data',
        'tipus',
        'descripcio',
        'context',
        'durada',
        'id_profesional',
        'centre_id',
        'document',
        'estat'
    ];

    public function professional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }

    
}

