<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\Mail;

use Carbon\Carbon;

use App\Apartment;
use App\Review;
use App\Service;

use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    public function index() 
    {
        $apartments = Apartment::where('active', 1)
                               ->whereHas('sponsor_plans', function($query) {
                                    $query->where('deadline', '>', Carbon::now());
                               })
                               ->inRandomOrder()
                               ->take(8)
                               ->get();

        $services = Service::all();
        $now = Carbon::now();

        return view('guest.home', compact('apartments', 'services', 'now'));
    }
}
