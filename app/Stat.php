<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        'apartment_id',
        'stat_type_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Relationships
     */
    
    // Stat_types table | Many to one
    public function statType() {
        return $this->belongsTo('App\StatType');
    }

    // Apartments table | Many to one
    public function apartment() {
        return $this->belongsTo('App\Apartment');
    }
}
