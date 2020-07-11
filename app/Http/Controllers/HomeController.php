<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Service;



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
}
