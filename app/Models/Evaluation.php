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
        'pregunta1', 'pregunta2', 'pregunta3', 'pregunta4', 'pregunta5',
        'pregunta6', 'pregunta7', 'pregunta8', 'pregunta9', 'pregunta10',
        'pregunta11', 'pregunta12', 'pregunta13', 'pregunta14', 'pregunta15',
        'pregunta16', 'pregunta17', 'pregunta18', 'pregunta19', 'pregunta20',
        'created_at',
        'updated_at',
        
        
    ];


    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }

    public function avaluador()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional_avaluador');
    }
    protected $casts = [
        'data' => 'date',
    ];

}