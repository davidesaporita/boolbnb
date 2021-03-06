<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Apartment;
use App\Message;
use App\Review;

class ReviewController extends Controller
{
    public function reviews() 
    {
        $user_id    = Auth::user()->id;
        $apartments = Apartment::where('user_id', $user_id)->get();
        
        // Apartments ids array
        $apartments_id = $apartments->pluck('id'); 

        $reviews    = Review::whereIn('apartment_id', $apartments_id)->orderBy('created_at', 'desc')->get();
        $now        = Carbon::now();

        return view('admin.reviews', compact('apartments', 'reviews', 'now'));
    }

    public function destroy(Review $review)
    {        
        if(empty($review)) {
            abort(404);
        }

        $deleted_review = $review->title;
        $deleted = $review->delete();

        if($deleted) {
            return redirect()->back()->with('message', 'Recensione eliminata');
        }
    }
}
