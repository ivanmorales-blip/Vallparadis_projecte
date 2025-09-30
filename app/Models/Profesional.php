<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    public function uniform(): HasMany{
        return $this->hasMany(Uniformity::class);
    }
}
