<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profesional;

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

    /**
     * Profesional encargado (uno solo)
     */
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'profesional_id');
    }

    /**
     * Profesionales añadidos por Drag & Drop (muchos)
     */
    public function professionals()
    {
        return $this->belongsToMany(
            Profesional::class,
            'projectes_comissions_profesional',
            'id_profesional',
            'id_projecte_comissio'); // nombre de la tabla pivot

    }
    /**
     * Relación con Centre
     */
    public function centre()
    {
        return $this->belongsTo(Center::class, 'centre_id'); 
    }
}
