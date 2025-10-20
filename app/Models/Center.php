<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $table= "center";
    protected $fillable = ['nom','adreça','telefon','email','activo'];
    protected $casts = [
        'activo' => 'integer',
    ];
}
 