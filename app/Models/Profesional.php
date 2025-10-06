<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $table= "profesional";
    protected $fillable = ['nom','cognoms','telefon','correu','adreça','estat'];

    /*public function uniform(): HasMany{
        return $this->hasMany(Uniformity::class);
    }*/
}
