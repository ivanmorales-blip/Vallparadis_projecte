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

    // Relación con Profesional
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'profesional_id');
    }

    // Relación con Centre
    public function centre()
    {
        return $this->belongsTo(Center::class, 'centre_id'); 
    }
}
