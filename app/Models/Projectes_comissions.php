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
        'profesional_id',
        'descripcio',
        'observacions',
        'centre_id',
        'estat', 
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }

    public function centre()
    {
        return $this->belongsTo(Center::class);
    }
}
