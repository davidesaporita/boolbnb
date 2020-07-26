<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Apartment;
use App\Category;
use App\Message;
use App\Review;
use App\Service;
use App\SponsorPlan;
use App\Stat;


class HomeController extends Controller
{
    public function index() {

        // All apartments for Auth::user()
        $apartments = Apartment::where('user_id', Auth::id())
                               ->orderBy('created_at', 'DESC')
                               ->get();

        // Apartments ids array
        $apartments_id = $apartments->pluck('id'); 

        // Messages
        $messages               = Message::whereIn('apartment_id', $apartments_id)->get();
        $unread_messages_number = $messages->where('read', 0)->count();

        // Metrics | Visite totali agli annunci
        $total_views_number = Stat::whereHas('statType', function (Builder $query) {
                                        $query->where('name', 'view');
                                    })
                                  ->whereIn('apartment_id', $apartments_id)
                                  ->count();

        // Numero totale recensioni
        $reviews = Review::whereIn('apartment_id', $apartments_id)->get();
        $total_reviews_number = $reviews->count();

        // Media voti ricevuti
        $ratings = $reviews->pluck('rating')->toArray();
        $average_rating = number_format(array_sum($ratings) / $total_reviews_number, 2);

        // Generals
        $categories   = Category::all();
        $services     = Service::all();
        $sponsorplans = SponsorPlan::all();

        // Carbon Now
        $now = Carbon::now();

        // Call view for dashboard
        return view('admin.index', compact('apartments', 
                                           'categories', 
                                           'services', 
                                           'sponsorplans',
                                           'unread_messages_number',
                                           'total_views_number',
                                           'total_reviews_number',
                                           'average_rating',
                                           'now'
                                        ));
        
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

        return view('admin.reviews', compact('apartments', 'reviews', 'now'));
    }
}
