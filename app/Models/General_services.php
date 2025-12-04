<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General_services extends Model
{
    use HasFactory;

    protected $table = 'general_services';

    protected $fillable = [
        'tipus',
        'contacte',
        'encarregat',
        'id_center',
        'observacions',
    ];

    /**
     * Relación con el centro.
     */
    public function center()
    {
        return $this->belongsTo(\App\Models\Center::class, 'id_center');
    }
}
