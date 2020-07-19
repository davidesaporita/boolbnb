<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Apartment;
use App\Stat;

class StatsController extends Controller
{
    public function query(Request $request) {       

        $apartment = Apartment::find($request->input('apartment_id'));

        $stats = Stat::whereApartmentId($apartment->id)
                     ->select( array(
                       \DB::raw('DATE(created_at) as date'),
                       \DB::raw('sum(stat_type_id = "1") as views'),
                       \DB::raw('sum(stat_type_id = "2") as info_requests'),
                       \DB::raw('sum(stat_type_id = "3") as reviews')
                     ))
                     ->groupBy('date')
                     ->orderBy('date')
                     ->get();

        return response()->json($stats);
    }
}
