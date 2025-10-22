<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $table= "tracking";
    protected $fillable = ['tipus','data','tema','comentari','id_profesional','id_profesional_registrador','estat'];
}
