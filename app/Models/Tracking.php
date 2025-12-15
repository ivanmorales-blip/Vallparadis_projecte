<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $table = 'tracking';

    protected $fillable = [
        'tipus',
        'data',
        'tema',
        'comentari',
        'id_profesional',
        'id_profesional_registrador',
        'id_general_services',
        'estat'
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }

    public function registrador()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional_registrador');
    }

    /**
     * Tracking pertenece a un servicio general
     */
    public function generalService()
    {
        return $this->belongsTo(General_services::class, 'id_general_services');
    }
}
