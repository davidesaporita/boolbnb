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
        $reviews    = Review::whereIn('apartment_id', $apartments)->get();
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
            return redirect()->route('admin.index')->with('deleted_review', $deleted_review);
        }
    }
}
