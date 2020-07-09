<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Relationships
     */
    
    // Apartments table | One to Many
    public function apartments() {
        return $this->hasMany('App\Apartment');
    }
}
