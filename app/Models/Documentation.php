<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    
    protected $table = 'profesionaldocumentation';

    protected $fillable = ['nom', 'data', 'fitxer', 'id_profesional'];

    protected $casts = [
    'data_renovacio' => 'datetime',
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
