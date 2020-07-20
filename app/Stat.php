<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Apartment;

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

    // Create stats records
    public static function addNewStat(Apartment $apartment, $stat_type_name) {
        $data['apartment_id'] = $apartment->id;
        $data['stat_type_id'] = StatType::where('name', $stat_type_name)->value('id');
        
        $newStat = new Stat();
        $newStat->fill($data);
        $newStat->save();
    }
}
