<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\Mail;

use App\Mail\NewMessage;
use Carbon\Carbon;

use App\Apartment;
use App\Message;
use App\Review;
use App\Service;
use App\Stat;
use App\StatType;

use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    public function index() 
    {
        $apartments = Apartment::where('active', 1)   ->whereHas('sponsor_plans', function($query) {$query->where('deadline', '>', Carbon::now());})
                                                    ->inRandomOrder()
                                                    ->take(10)
                                                    ->get();;
        $services = Service::all();
        $now = Carbon::now();

        return view('guest.welcome', compact('apartments', 'services', 'now'));
    }

    public function show(Apartment $apartment)
    {
        // Add new "view" stat to stats table
        Stat::addNewStat($apartment, 'view');

        return view('guest.apartments.show', compact('apartment'));

    }

    public function send(Request $request, Apartment $apartment)
    {
        // todo validation

        $data = $request->all();

        // get apartment id
        $data['apartment_id'] = $apartment->id;

        $newRequest = new Message();
        $newRequest->fill($data);
        $saved = $newRequest->save();

        if($saved) {

            // Add new "view" stat to stats table
            Stat::addNewStat($apartment, 'message');

            Mail::to('user@test.com')->send(new NewMessage($newRequest));
            
            // todo redirect
            return view('guest.apartments.show', compact('apartment'));
        }

    }
    

    public function reviews(Request $request, Apartment $apartment) {

        $data = $request->all();

        // get apartment id
        $data['apartment_id'] = $apartment->id;

        $newReview = new Review();
        $newReview->fill($data);
        $saved = $newReview->save();


        if($saved) {

            // Add new "view" stat to stats table
            Stat::addNewStat($apartment, 'review');

            return view('guest.apartments.show', compact('apartment'));
        }
    }
}
