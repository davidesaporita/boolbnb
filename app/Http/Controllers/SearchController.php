<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $test = $request->input('test');

        $dd($test);
        
        return view('search.index', compact());
    }
}
