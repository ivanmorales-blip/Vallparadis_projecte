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
    'actiu', 
];


    public function centre()
    {
        return $this->belongsTo(Center::class);
    }

    // Profesional afectat
    public function afectat()
    {
        return $this->belongsTo(Profesional::class, 'professional_afectat');
    }

    // Qui registra
    public function registra()
    {
        return $this->belongsTo(User::class, 'professional_registra');
    }

    // Derivat a
    public function derivat()
    {
        return $this->belongsTo(Profesional::class, 'derivat_a');
    }
}
