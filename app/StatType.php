<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatType extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Relationships
     */
    
    // Stat table | One to Many
    public function stat() {
        return $this->hasMany('App\Stat');
    }
}
