<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Apartment;
use App\Stat;

class ApartmentController extends Controller
{
    public function show($country, $region, $city, $title, Request $request)
    {
        $id = $request->session()->get('id');

        $apartment = Apartment::find($id);

        // Add new "view" stat to stats table
        Stat::addNewStat($apartment, 'view');

        return view('guest.apartments.show', compact('apartment'));

    }

    public function customizeUrl(Apartment $apartment)
    {
        return redirect()->route('apartments.show.custom', [
            'category'  => $this->slugify($apartment->category->name),
            'country'   => $this->slugify($apartment->country),
            'region'    => $this->slugify($apartment->region),
            'city'      => $this->slugify($apartment->city),
            'title'     => $this->softSlugify($apartment->title)
        ])->with('id', $apartment->id);
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

    private function slugify($string, $separator = '-')
    {
        return ucwords(strtolower(Str::slug($string, $separator)), $separator);
    }

    private function softSlugify($string, $separator = '-')
    {
        return Str::slug($string, $separator);
    }
}
