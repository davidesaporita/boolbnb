<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Apartment;
use App\Service;

class SearchController extends Controller
{
    private $apartments;
    private $services;

    public function __construct()
    {
        $this->apartments = Apartment::all();
        $this->services   = Service::all();
    }

    public function serviceQuery(Request $request) 
    {
        $apartment_id = $request->input('id');

        $apartment = Apartment::find($request->id);
        $services = $apartment->services()->select()->get();

        return response()->json($services);
    }


    public function query(Request $request)
    {   
        $now = Carbon::now();

        // Geolocation data
        $geo_lat          = $request->input('geo_lat')          ? $request->input('geo_lat')          : null;
        $geo_lng          = $request->input('geo_lng')          ? $request->input('geo_lng')          : null;
        
        // Numeric filters
        $radius           = $request->input('radius')           ? $request->input('radius')           : 20;
        $rooms_number_min = $request->input('rooms_number_min') ? $request->input('rooms_number_min') : 0;
        $beds_number_min  = $request->input('beds_number_min')  ? $request->input('beds_number_min')  : 0;

        // Service filters
        $wifi             = $request->input('wifi')             ? 1 : null;  
        $posto_macchina   = $request->input('posto_macchina')   ? 2 : null;  
        $piscina          = $request->input('piscina')          ? 3 : null;  
        $portineria       = $request->input('portineria')       ? 4 : null;  
        $sauna            = $request->input('sauna')            ? 5 : null;  
        $vista_mare       = $request->input('vista_mare')       ? 6 : null;
       
        // Checking active service filters
        $request_services = array($wifi, $posto_macchina, $piscina, $portineria, $sauna, $vista_mare);

        foreach($request_services as $service) {
            !$service ?: $service_filters[] = $service;
        }

        // Fields doesn't have to show
        $hidden_fields = ['created_at', 'updated_at'];

        // Retrieving Haversine formula for geolocation
        $haversine = $this->haversine($geo_lat, $geo_lng, $radius);

        // All active sponsored apartments
        $sponsored_apartments = Apartment::selectRaw("*, {$haversine} AS distance")
                                      ->where('active', 1)
                                      ->whereRaw("{$haversine} < ?", [$radius])
                                      ->where('rooms_number', '>=', $rooms_number_min)
                                      ->where('beds_number',  '>=', $beds_number_min)
                                      ->whereHas('sponsor_plans', function($query) use ($now) {
                                            $query->selectRaw('deadline')
                                                  ->where('deadline', '>=', $now);
                                        })
                                      ->with('sponsor_plans');
        
        // Add service filters (if requested) to query
        if(isset($service_filters) && count($service_filters) > 0) {
            foreach($service_filters as $filter) {
                $sponsored_apartments = $sponsored_apartments->whereHas('services', function (Builder $query) use ($filter) {
                    $query->where('service_id', $filter);
                });
            }
        }
        
        $sponsored_apartments = $sponsored_apartments->orderBy('distance', 'asc')->get();
        $sponsored_apartments->map(function ($sponsored_apartment) {
            $sponsored_apartment['sponsored'] = 1;
            return $sponsored_apartment;
        });

        // All apartments 
        $active_apartments = Apartment::selectRaw("*, {$haversine} AS distance")
                                      ->where('active', 1)
                                      ->whereRaw("{$haversine} < ?", [$radius])
                                      ->where('rooms_number', '>=', $rooms_number_min)
                                      ->where('beds_number',  '>=', $beds_number_min)
                                      ->with('sponsor_plans');
        
        // Add service filters (if requested) to query
        if(isset($service_filters) && count($service_filters) > 0) {
            foreach($service_filters as $filter) {
                $active_apartments = $active_apartments->whereHas('services', function (Builder $query) use ($filter) {
                    $query->where('service_id', $filter);
                });
            }
        }
        
        $active_apartments = $active_apartments->orderBy('distance', 'asc')->get();        
        
        $other_apartments = $active_apartments->diff($sponsored_apartments);
        $other_apartments->map(function ($other_apartments) {
            $other_apartments['sponsored'] = 0;
            return $other_apartments;
        });

        $apartments = $sponsored_apartments->merge($other_apartments);

        return response()->json($apartments);
    }

    private function haversine($geo_lat, $geo_lng, $radius) {
        
        return "(6371 * acos(cos(radians(" . $geo_lat . "))
               * cos(radians(`geo_lat`))
               * cos(radians(`geo_lng`)
               - radians(" . $geo_lng . "))
               + sin(radians(" . $geo_lat . "))
               * sin(radians(`geo_lat`))))";
    }
}
