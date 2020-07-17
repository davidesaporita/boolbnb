<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'rooms_number',
        'beds_number',
        'bathrooms_number',
        'square_meters',
        'country',
        'region',
        'province',
        'city',
        'address',
        'zip_code',
        'geo_lat',
        'geo_lng',
        'active',
        'views',
        'featured_img'
    ];

    /**
     * Relationships
     */
    
    // Users table | Many to One
    public function user() {
        return $this->belongsTo('App\User');
    }

    // Users table | Many to One
    public function category() {
        return $this->belongsTo('App\Category');
    }

    // Info_request table | One to Many
    public function info_requests() {
        return $this->hasMany('App\InfoRequest');
    }

    // Media table | One to Many
    public function media() {
        return $this->hasMany('App\Media');
    }

    // Reviews table | One to Many
    public function reviews() {
        return $this->hasMany('App\Review');
    }

    // Stats table | One to Many
    public function stats() {
        return $this->hasMany('App\Stat');
    }

    // Services table | Many to Many
    public function services() {
        return $this->belongsToMany('App\Service', 'apartments_services');
    }

    // Sponsor_plans table | Many to Many
    public function sponsor_plans() {
        return $this->belongsToMany('App\SponsorPlan', 'sponsorships')
                    ->as('sponsorships')
                    ->withPivot('transaction_id', 'amount', 'start', 'deadline')
                    ->withTimestamps();
    }   
}
