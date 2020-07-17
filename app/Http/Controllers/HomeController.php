<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\Mail;

use App\Apartment;
use App\Service;
use App\Mail\NewInfoRequest;
use App\InfoRequest;
use App\Review;

use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    public function index() 
    {
        $apartments = Apartment::where('active', 1)->paginate(9);
        $services = Service::all();

        return view('guest.welcome', compact('apartments', 'services'));
    }

    public function show(Apartment $apartment)
    {
        



        return view('guest.apartments.show', compact('apartment'));

    }

    public function send(Request $request, Apartment $apartment)
    {
        // todo validation

        $data = $request->all();

        // get apartment id
        $data['apartment_id'] = $apartment->id;

        $newRequest = new InfoRequest();
        $newRequest->fill($data);
        $saved = $newRequest->save();

        

        if($saved) {

            Mail::to('user@test.com')->send(new NewInfoRequest($newRequest));
            
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
            return view('guest.apartments.show', compact('apartment'));
        }
    }
}
