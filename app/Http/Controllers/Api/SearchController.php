<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        // Todo: improve

        $geo_lat          = $request->input('geo_lat')          ? $request->input('geo_lat')          : null;
        $geo_lng          = $request->input('geo_lng')          ? $request->input('geo_lng')          : null;
        $radius           = $request->input('radius')           ? $request->input('radius')           : 20;
        $rooms_number_min = $request->input('rooms_number_min') ? $request->input('rooms_number_min') : 0;
        $beds_number_min  = $request->input('beds_number_min')  ? $request->input('beds_number_min')  : 0;
        $wifi             = $request->input('wifi')             ? 1                                   : null;  
        $posto_macchina   = $request->input('posto_macchina')   ? 2                                   : null;  
        $piscina          = $request->input('piscina')          ? 3                                   : null;  
        $portineria       = $request->input('portineria')       ? 4                                   : null;  
        $sauna            = $request->input('sauna')            ? 5                                   : null;  
        $vista_mare       = $request->input('vista_mare')       ? 6                                   : null;  
       

        $request_services = array($wifi, $posto_macchina, $piscina, $portineria, $sauna, $vista_mare);

        $array = [];

        foreach($request_services as $service) {
            !$service ?: $array[] = $service;
        }

        var_dump($array, $geo_lat, $geo_lng, $radius);

        $haversine = $this->haversine($geo_lat, $geo_lng, $radius);

        if(count($array) > 0) {
            $apartments = Apartment::where('active', 1)
                                   ->selectRaw("*, {$haversine} AS distance")
                                   ->whereRaw("{$haversine} < ?", [$radius])
                                   ->where('rooms_number', '>=', $rooms_number_min)
                                   ->where('beds_number',  '>=', $beds_number_min)
                                   ->whereHas('services', function($query) use($request_services, $array) {
                                        $query->where('service_id', $array);
                                   })
                                   ->orderBy('distance', 'asc')
                                   ->get();
        } else {
            $apartments = Apartment::where('active', 1)
                                   ->selectRaw("*, {$haversine} AS distance")
                                   ->whereRaw("{$haversine} < ?", [$radius])
                                   ->where('rooms_number', '>=', $rooms_number_min)
                                   ->where('beds_number',  '>=', $beds_number_min)
                                   ->orderBy('distance', 'asc')
                                   ->get();   
        }
        
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
