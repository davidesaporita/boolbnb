<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Apartment;

class SearchController extends Controller
{
    private $apartments;

    public function __construct()
    {
        $this->apartments = Apartment::all();
    }

    public function index()
    {
        return response()->json($this->apartments);
    }
}
