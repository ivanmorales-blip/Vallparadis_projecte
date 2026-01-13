<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemaPendent extends Model
{
    protected $table = 'Tema_pendent';

    protected $fillable = [
        'centre_id',
        'professional_id',
        'data_opertura',
        'descripcio',
        'estat',
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
        return $this->hasMany(Tracking::class, 'id_human_resource', 'id');
    }
}
