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

    public function trackings()
    {
        return $this->hasMany(Tracking::class, 'tema_pendent_id');
    }


public function profesional() {
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

}
