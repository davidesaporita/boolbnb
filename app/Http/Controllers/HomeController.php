<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\Service;
use App\InfoRequest;

use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    public function index() 
    {
        $apartments = Apartment::paginate(9);
        $services = Service::all();

        return view('guest.welcome', compact('apartments', 'services'));
    }

    public function show(Apartment $apartment)
    {
        return view('guest.apartments.show', compact('apartment'));
    }

    public function send(Request $request)
    {
        // to do validation

        $data = $request->all();

        // get apartment id
        $data['apartment_id'] = 1;

        $newRequest = new InfoRequest();
        $newRequest->fill($data);
        $newRequest->save();

        // to do redirect

    }
}
