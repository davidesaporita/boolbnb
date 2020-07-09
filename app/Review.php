<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'apartment_id',
        'first_name',
        'last_name',
        'title',
        'body',
        'rating'
    ];

    /**
     * Relationships
     */
    
    // Apartments table | Many to One
    public function apartment() {
        return $this->belongsTo('App\Apartment');
    }
}
