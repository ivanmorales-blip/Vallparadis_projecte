<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguiment extends Model
{
    use HasFactory;

    protected $table = 'seguiments';

    protected $fillable = [
        'data',
        'id_professional',
        'descripcio',
        'document',
        'centre_id',
        'actiu',
    ];

    public function centre()
    {
        return $this->belongsTo(Center::class);
    }

    
    public function professional()
    {
        return $this->belongsTo(Profesional::class, 'id_professional');
    }
}
