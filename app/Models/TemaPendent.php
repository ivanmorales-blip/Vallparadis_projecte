<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemaPendent extends Model
{
    use HasFactory;

    protected $table = 'temes_pendents';

    protected $fillable = [
        'centre_id',
        'data_obertura',
        'tema_pendent',
        'professional_afectat',
        'professional_registra',
        'derivat_a',
        'descripcio',
        'document',
        'actiu'
    ];

    // Profesional afectado
    public function profesional()
    {
        // Ajusta 'Profesional' al nombre de tu modelo de profesionales
        return $this->belongsTo(Profesional::class, 'professional_afectat');
    }

    public function professionalRegistra()
    {
        return $this->belongsTo(User::class, 'professional_registra');
    }

    public function derivatA()
    {
        return $this->belongsTo(Profesional::class, 'derivat_a');
    }

    public function trackings()
    {
        return $this->hasMany(\App\Models\Tracking::class, 'id_human_resource'); 
    }
}
