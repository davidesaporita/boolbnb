<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Apartment;
use App\Stat;

class StatsController extends Controller
{
    public function index(Apartment $apartment) {
        $views = Stat::selectRaw('count(*) as views, MONTH(created_at) as month')
            ->where('stat_type_id', 1)
            ->where('apartment_id', $apartment->id)
            ->groupBy('month')
            ->get();

        $info_requests = Stat::selectRaw('count(*) as info_requests, MONTH(created_at) as month')
            ->where('stat_type_id', 2)
            ->where('apartment_id', $apartment->id)
            ->groupBy('month')
            ->get();

        $reviews = Stat::selectRaw('count(*) as reviews, MONTH(created_at) as month')
            ->where('stat_type_id', 3)
            ->where('apartment_id', $apartment->id)
            ->groupBy('month')
            ->get();

        return view('admin.apartments.stats.index', compact('apartment', 'views', 'info_requests', 'reviews'));
    }
}
