<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorPlan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'hours',
        'price'
    ];

    /**
     * Relationships
     */
    
    // Apartments table | Many to Many
    public function apartments() {
        return $this->belongsToMany('App\Apartment', 'sponsorships', 'apartment_id', 'sponsor_plan_id')
                    ->as('sponsorships')
                    ->withPivot('transaction_id', 'amount', 'start', 'deadline')
                    ->withTimestamps();
    }    
}
