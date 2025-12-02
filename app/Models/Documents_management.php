<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents_management extends Model
{
    // Table name (because Laravel would look for documents_managements otherwise)
    protected $table = 'documents_management';

    // Mass-assignable fields
    protected $fillable = [
        'tipus',
        'data',
        'descripcio',
        'professional_id',
        'centre_id',
        'arxiu',
        'estat',
    ];

    // Automatically cast dates to Carbon instances
    protected $casts = [
        'data' => 'datetime',
    ];

    /**
     * Relationships
     */

    // A document belongs to a center
    public function centre()
    {
        return $this->belongsTo(Center::class, 'centre_id');
    }

    // A document belongs to a professional
    public function professional()
    {
        return $this->belongsTo(Profesional::class, 'professional_id');
    }
}
