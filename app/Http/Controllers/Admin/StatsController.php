<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Apartment;
use App\Stat;

class StatsController extends Controller
{
    public function index(Apartment $apartment) {
        $stats_by_day = Stat::whereApartmentId($apartment->id)
                            ->select( array(
                                \DB::raw('DATE(created_at) as date'),
                                \DB::raw('sum(stat_type_id = "1") as views'),
                                \DB::raw('sum(stat_type_id = "2") as messages'),
                                \DB::raw('sum(stat_type_id = "3") as reviews')
                            ))
                            ->groupBy('date')
                            ->orderBy('date')
                            ->get();

        $stats_by_month = Stat::whereApartmentId($apartment->id)
                            ->select( array(
                                \DB::raw("DATE_FORMAT(created_at, '%Y-%m') as date"),
                                \DB::raw('sum(stat_type_id = "1") as views'),
                                \DB::raw('sum(stat_type_id = "2") as messages'),
                                \DB::raw('sum(stat_type_id = "3") as reviews')
                            ))
                            ->where('created_at', '>=', '2019-07-01')
                            ->groupBy('date')
                            ->orderBy('date', 'asc')
                            ->get();

        return view('admin.apartments.stats.index', [ 
            'apartment' => $apartment, 
            'complete_stats' => $stats_by_day,
            'monthly_stats' => $stats_by_month
        ]);
    }
}
