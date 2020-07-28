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

class MessageController extends Controller
{
    public function inbox() 
    {
        $user_id    = Auth::user()->id;
        $apartments = Apartment::where('user_id', $user_id)->get();
        $messages   = Message::whereIn('apartment_id', $apartments)->get();
        $now        = Carbon::now();

        return view('admin.inbox', compact('apartments', 'messages', 'now'));
    }

    public function destroy(Message $message)
    {        
        if(empty($message)) {
            abort(404);
        }

        $deleted_message = $message->title;
        $deleted = $message->delete();

        if($deleted) {
            return redirect()->route('admin.index')->with('deleted_message', $deleted_message);
        }
    }

    public function toggle(Message $message)
    {
        if($message->read == 0) {
            $message->read = 1;
        } else {
            $message->read = 0;
        }
        
        $updated = $message->update();

        if($updated) {
            return redirect()->route('admin.index', compact('message'));
        }
    }
}
