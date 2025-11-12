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
    'data', 'sumatori', 'observacions', 'arxiu',
    'id_profesional', 'id_profesional_avaluador', 'estat',
    'q0','q1','q2','q3','q4','q5','q6','q7','q8','q9',
    'q10','q11','q12','q13','q14','q15','q16','q17','q18','q19'
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