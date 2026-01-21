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

    // Profesional que registra (usuario)
    public function professionalRegistra()
    {
        return $this->belongsTo(User::class, 'professional_registra');
    }

    // Profesional al que se deriva
    public function derivatA()
    {
        return $this->belongsTo(Profesional::class, 'derivat_a');
    }
}
