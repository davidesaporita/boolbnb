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
        $apartments = Apartment::where('active', 1)->paginate(9);
        $services = Service::all();

        return view('guest.home', compact('apartments', 'services'));
    }
}
