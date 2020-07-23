<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Apartment;
use App\Category;
use App\Message;
use App\Review;
use App\Service;
use App\SponsorPlan;


class HomeController extends Controller
{
    public function index() {

        $apartments   = Apartment::all();
        $categories   = Category::all();
        $services     = Service::all();
        $sponsorplans = SponsorPlan::all();

        return view('admin.index', compact('apartments', 'categories', 'services', 'sponsorplans'));
    }

    public function inbox() 
    {
        $user_id    = Auth::user()->id;
        $apartments = Apartment::where('user_id', $user_id)->get();
        $messages   = Message::whereIn('apartment_id', $apartments)->get();
        $now        = Carbon::now();

        return view('admin.inbox', compact('apartments', 'messages', 'now'));
    }

    public function reviews() 
    {
        $user_id    = Auth::user()->id;
        $apartments = Apartment::where('user_id', $user_id)->get();
        $reviews    = Review::whereIn('apartment_id', $apartments)->get();
        $now        = Carbon::now();

        return view('admin.inbox', compact('apartments', 'reviews', 'now'));
    }
}
