<?php

namespace App\Http\Controllers;

use App\Mail\NewMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

use App\Apartment;
use App\Message;
use App\Review;
use App\Service;
use App\Stat;
use App\StatType;

class ApartmentController extends Controller
{
    public function show($category, $country, $region, $city, $title, Apartment $apartment)
    {
        $now = Carbon::now();

        // Add new "view" stat to stats table
        Stat::addNewStat($apartment, 'view');
        
        // Default value
        $sponsored = false;

        // Check if sponsored
        foreach($apartment->sponsor_plans as $plan) {
            $sponsored = $plan->sponsorships->deadline > $now ? true : false;
        }


        return view('guest.apartments.show', compact('apartment', 'sponsored'));

    }

    public function discover($country = null, $region = null, $city = null)
    {
        $now = Carbon::now();

        if(isset($country) && $region === null && $city === null) {
            $apartments = Apartment::where('country', $country)->get();
            return view('guest.discover.country', compact('apartments', 'country', 'now'));
        }
        
        if(isset($country) && isset($region) && !isset($city)) {
            $apartments = Apartment::where('region', $region)->get();
            return view('guest.discover.region', compact('apartments', 'country', 'region', 'now'));
        }
        
        if(isset($country) && isset($region) && isset($city)) {
            $apartments = Apartment::where('city', $city)->get();
            return view('guest.discover.city', compact('apartments', 'country', 'region', 'city', 'now'));
        }
    }

    public function send(Request $request, Apartment $apartment)
    {
        $request->validate($this->messageValidationRules());

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

            $request->session()->put('message', 'La tua richiesta di informazioni è stata inviata con successo!');
            
            return redirect()->route('apartments.show', $apartment);
        }
    }
    

    public function reviews(Request $request, Apartment $apartment) 
    {
        $request->validate($this->reviewValidationRules());

        $data = $request->all();
        $data['apartment_id'] = $apartment->id;

        $newReview = new Review();
        $newReview->fill($data);
        $saved = $newReview->save();

        if($saved) {

            // Add new "view" stat to stats table
            Stat::addNewStat($apartment, 'review');

            $request->session()->put('message', 'La tua recensione è stata pubblicata con successo!');

            return redirect()->route('apartments.show', $apartment);
        }
    }

    public function customizeUrl(Apartment $apartment)
    {
        return redirect()->route('apartments.show.custom', [
            'category'  => $this->slugify($apartment->category->name),
            'country'   => $this->slugify($apartment->country),
            'region'    => $this->slugify($apartment->region),
            'city'      => $this->slugify($apartment->city),
            'title'     => $this->softSlugify($apartment->title),
            $apartment
        ]);
    }
    
    private function slugify($string, $separator = '-')
    {
        return ucwords(strtolower(Str::slug($string, $separator)), $separator);
    }

    private function softSlugify($string, $separator = '-')
    {
        return Str::slug($string, $separator);
    }

    /**
     * Validation rules.
     *
     * @return \Illuminate\Http\Response
     */
    private function messageValidationRules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'title' => 'required|string|max:255',
            'body'  => 'required|string|max:1000',
        ];
    }

    private function reviewValidationRules()
    {
        return [
            'first_name' => 'required|string|max:40',
            'last_name'  => 'required|string|max:40',
            'title'      => 'required|string|max:255',
            'body'       => 'required|string|max:1000',
            'rating'     => 'required|numeric|between:1,5'
        ];
    }
}
