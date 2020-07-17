<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Apartment;
use App\Category;
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
}
