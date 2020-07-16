<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Apartment;

class StatsController extends Controller
{
    public function index(Apartment $apartment) {
        return view('admin.apartments.stats.index', compact('apartment'));
    }
}
