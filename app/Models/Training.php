<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $table = 'training'; // tabla real

    protected $fillable = [
        'nom_curs',
        'data_inici',
        'data_fi',
        'hores',
        'objectiu',
        'descripcio',
        'formador',
        'id_center',
        'estat',
        'document',
    ];

    /**
     * Relación con el centro
     */
    public function center()
{
    return $this->belongsTo(Center::class, 'id_center');
}
    /**
     * Relación muchos a muchos con profesionales
     */
    public function professionals()
    {
        return $this->belongsToMany(
            Profesional::class,         // modelo relacionado
            'professional_training',     // nombre de la tabla pivote
            'id_training',               // columna local (training)
            'id_profesional'             // columna del modelo relacionado (professional)
        );
    }
}
