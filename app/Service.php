<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relationships
     */
    
    // Apartments table | Many to Many
    public function apartments() {
        return $this->belongsToMany('App\Apartment', 'apartments_services');
    }
}
