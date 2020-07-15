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

    public function services() 
    {
        return response()->json($this->services);
    }

    public function query(Request $request)
    {
        // Todo: improve

        $geo_lat          = $request->input('geo_lat')          ? $request->input('geo_lat')          : null;
        $geo_lng          = $request->input('geo_lng')          ? $request->input('geo_lng')          : null;
        $rooms_number_min = $request->input('rooms_number_min') ? $request->input('rooms_number_min') : 0;
        $beds_number_min  = $request->input('beds_number_min')  ? $request->input('beds_number_min')  : 0;
        $wifi             = $request->input('wifi')             ? 1 : null;  // Yes = id ---- No = null
        $posto_macchina   = $request->input('posto_macchina')   ? 2 : null;  // Yes = id ---- No = null
        $piscina          = $request->input('piscina')          ? 3 : null;  // Yes = id ---- No = null
        $portineria       = $request->input('portineria')       ? 4 : null;  // Yes = id ---- No = null
        $sauna            = $request->input('sauna')            ? 5 : null;  // Yes = id ---- No = null
        $vista_mare       = $request->input('vista_mare')       ? 6 : null;  // Yes = id ---- No = null
       
        $request_services = array($wifi, $posto_macchina, $piscina, $portineria, $sauna, $vista_mare);

        $apartments = Apartment::where('active', 1)
                               ->where('geo_lat', $geo_lat)
                               ->where('geo_lng', $geo_lng)
                               ->where('rooms_number', '>=', $rooms_number_min)
                               ->where('beds_number', '>=', $beds_number_min)
                               ->whereHas('services', function($query) use($request_services) {
                                   foreach($request_services as $service) {
                                       if($service) {
                                            $query->where('service_id', $service);
                                       }
                                   }
                               })
                               ->get();

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
