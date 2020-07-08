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
        'title',
        'description',
        'rooms_number',
        'beds_number',
        'bathrooms_number',
        'square_meters',
        'address',
        'geo_lat',
        'geo_lon',
        'active',
        'featured_img'
    ];

    /**
     * Relationships
     */
    
    // Users table | Many to One
    public function user() {
        return $this->belongsTo('App\User');
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

    // Services table | Many to Many
    public function services() {
        return $this->belongsToMany('App\Service');
    }

    // Sponsor_plans table | Many to Many
    public function sponsor_plans() {
        return $this->belongsToMany('App\SponsorPlan');
    }
    
}
