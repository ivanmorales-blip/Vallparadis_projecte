<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profesional;

class Evaluation extends Model
{
    use HasFactory;
    protected $table = 'evaluation';

    protected $fillable = [
        'data',
        'sumatori',
        'observacions',
        'arxiu',
        'id_profesional',
        'id_profesional_avaluador',
        'estat',
        'created_at',
        'updated_at',
        
    ];


    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }

    public function profesionalAvaluador()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional_avaluador');
    }

}