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
    public function trainings()
    {
        return $this->belongsToMany(
            Training::class,
            'professional_training',
            'id_profesional',   // columna local (professional)
            'id_training'       // columna del modelo relacionado (training)
        );
    }
    public function center()
    {
        return $this->belongsTo(Center::class, 'id_center');
    }
    public function trackings()
    {
        return $this->hasMany(Tracking::class, 'id_profesional');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'id_profesional');
    }
   public function projectes_comissions()
    {
        return $this->belongsToMany(
            Projectes_comissions::class,
            'projectes_comissions_profesional', // tabla pivot
        );
    }

    /*public function uniform(): HasMany{
        return $this->hasMany(Uniformity::class);
    }*/
}
