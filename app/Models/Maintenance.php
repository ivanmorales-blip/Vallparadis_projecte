<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';

    protected $fillable = [
        'data_obertura',
        'descripcio',
        'centre_id',
        'documentacio',
        'responsable',
        'estat',
    ];

    protected $casts = [
        'data' => 'datetime',
    ];

    public function centre()
    {
        return $this->belongsTo(Center::class, 'centre_id');
    }

    public function professional()
    {
        return $this->belongsTo(Profesional::class, 'professional_id');
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class, 'id_manteniment', 'id');
    }
}
