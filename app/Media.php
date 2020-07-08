<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'apartment_id',
        'path',
        'caption',
        'type'
      ];
  
    /**
     * Relationships
     */
    
    // Apartments table | Many to One
    public function apartment() {
        return $this->belongsTo('App\Apartment');
    }
}
