<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'apartment_id',
      'guest_email',
      'title',
      'body'
    ];

    /**
     * Relationships
     */
    
    // Apartments table | Many to One
    public function apartment() {
        return $this->belongsTo('App\Apartment');
    }
}
