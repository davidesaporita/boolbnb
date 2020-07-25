<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Mail\NewMessage;
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
        // Add new "view" stat to stats table
        Stat::addNewStat($apartment, 'view');

        return view('guest.apartments.show', compact('apartment'));

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
}
