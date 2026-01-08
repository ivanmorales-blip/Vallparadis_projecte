<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General_services extends Model
{
    use HasFactory;

    protected $table = 'general_services';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'tipus',
        'contacte',
        'encarregat',
        'horari',
        'observacions',
        'id_center',
    ];

    /**
     * Relación con el centro.
     * Un servicio pertenece a un centro
     */
    public function center()
    {
        return $this->belongsTo(\App\Models\Center::class, 'id_center');
    }

    /**
     * Relación con los trackings.
     * Un servicio tiene muchos seguimientos
     */
    public function trackings()
    {
        return $this->hasMany(\App\Models\Tracking::class, 'id_general_services');
    }
}
