<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projectes_comissions extends Model
{
    protected $table = 'projectes_comissions';

    protected $fillable = [
        'nom',
        'tipus',
        'data_inici',
        'id_profesional',
        'descripcio',
        'observacions',
        'id_center',
        'estat', 
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
