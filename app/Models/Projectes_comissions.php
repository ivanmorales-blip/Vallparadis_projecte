<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projectes_comissions extends Model
{
    protected $fillable = ['nom','tipus','profesional_id','descripcio','observacio','centre_id'];
}
