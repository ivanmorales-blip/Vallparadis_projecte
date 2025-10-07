<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $table= "profesional";
    protected $fillable = ['nom','cognom','telefon','email','adreça','estat','id_center'];

    /*public function uniform(): HasMany{
        return $this->hasMany(Uniformity::class);
    }*/
}
