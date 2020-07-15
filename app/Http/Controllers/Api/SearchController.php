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

    public function apitest(Request $request)
    {
        $geo_lat          = $request->input('geo_lat') ? $request->input('geo_lat') : null;
        $geo_lng          = $request->input('geo_lng') ? $request->input('geo_lng') : null;
        $rooms_number_min = $request->input('rooms_number_min') ? $request->input('rooms_number_min') : 0;
        $beds_number_min  = $request->input('beds_number_min') ? $request->input('beds_number_min') : 0;
        


        $wifi             = $request->input('wifi')           ? 1 : null;            // Yes = 1 ---- No = 0
        $posto_macchina   = $request->input('posto_macchina') ? 2 : null;  // Yes = 1 ---- No = 0
        $piscina          = $request->input('piscina')        ? 3 : null;         // Yes = 1 ---- No = 0
        $portineria       = $request->input('portineria')     ? 4 : null;      // Yes = 1 ---- No = 0
        $sauna            = $request->input('sauna')          ? 5 : null;           // Yes = 1 ---- No = 0
        $vista_mare       = $request->input('vista_mare')     ? 6 : null;      // Yes = 1 ---- No = 0
        
       
        $request_services = array($wifi, $posto_macchina, $piscina, $portineria, $sauna, $vista_mare);

        $apartments = Apartment::where('active', 1)
                               ->Where('geo_lat', $geo_lat)
                               ->Where('geo_lng', $geo_lng)
                               ->Where('rooms_number', '>=', $rooms_number_min)
                               ->Where('beds_number', '>=', $beds_number_min)
                               ->whereHas('services', function($query) use($request_services) {
                                   foreach($request_services as $service) {
                                       if($service) {
                                            $query->where('service_id', $service);
                                       }
                                   }
                                
                                // $query->whereIn('service_id', [2, 5]);
                               })
                               ->get();
        
        //$query = $apartments->services->wherePivot('service_id', $wifi);

        return response()->json($apartments);
    }

    // public function rooms_number(Request $request)
    // {
    //     $query = Apartment::where('rooms_number', $request->input('num'));
    //     return response()->json($query);
    // }

    // public function apartment(Request $request)
    // {
    //     dd($request['id']);
    //     $apartment = Apartment::where('id', $request->input('id'));
    //     return response()->json($apartment);
    // }
}
