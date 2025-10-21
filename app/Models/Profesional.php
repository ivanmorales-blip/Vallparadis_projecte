<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $table= "profesional";
    protected $fillable = ['nom','cognom','telefon','email','taquilla','adreça','talla_samarreta','talla_pantalons',
    'talla_sabates','data_renovacio','estat','id_center'];

    protected $casts = [
    'data_renovacio' => 'datetime',
];


    /*public function uniform(): HasMany{
        return $this->hasMany(Uniformity::class);
    }*/
}
