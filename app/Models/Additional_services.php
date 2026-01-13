<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Additional_services extends Model
{
        protected $fillable = [
        'tipus',
        'contacte',
        'responsable',
        'data_inici',
        'centre_id',
        'observacions',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class, 'id_center');
    }
}
