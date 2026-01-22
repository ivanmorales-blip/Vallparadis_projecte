<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accidentabilitat extends Model
{
    protected $table = 'accidentability';

    protected $fillable = [
        'data',
        'tipus',
        'descripcio',
        'context',
        'durada'
    ];
}
