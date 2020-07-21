<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\Apartment;
use App\Category;
use App\Media;
use App\Service;

class ApartmentController extends Controller
{
    // Variables
    private $maxPathImg;
    
    public function __construct()
    {
        $this->maxPathImg = 5;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(9);
        $now = Carbon::now();
        // Ref
        $messages_number = 0;
        $numreviews = 0;
        $rating = 0;
        $numvotes = 0;
        foreach ($apartments as $apartment) {
            // Info requests count
            foreach ($apartment->messages as $message) {
                $messages_number++;    
            }
            // Reviews average
            foreach ($apartment->reviews as $review) {
                $numreviews++;  
                $numvotes++;
                $rating += $review->rating;
            }
            if ($numvotes != 0) {
                $fullaverage = $rating / $numvotes;
                $average = round($fullaverage, 2);
            }
            elseif ($numvotes == 0) {
                $fullaverage = 0;
                $average = 0;
            }
        }

        return view('admin.apartments.index', compact('apartments', 'now', 'messages_number', 'numreviews', 'numvotes', 'average'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $categories = Category::all();
        return view('admin.apartments.create', compact('services', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Todo: Add validations via validationRules() references

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['featured_img'] = Storage::disk('public')->put('images', $data['featured_img']);

        $newApartment = new Apartment();
        $newApartment->fill($data);
        $saved = $newApartment->save();
        
        if($saved) {
            if(!empty($data['services'])) {
                $newApartment->services()->attach($data['services']);
            }
            if(!empty($data['media'])) {
                $counter = 0;
                foreach($data['media'] as $path) {
                    if($counter < $this->maxPathImg) {
                        $path = Storage::disk('public')->put('images', $path);
                        $newMedia = new Media();
                        $newMedia->apartment_id = $newApartment->id;
                        $newMedia->path = $path;
                        $newMedia->type = 'img';
                        $newMedia->save();
                        $counter++;
                    } else {
                        break;
                    }
                }
            }
            return redirect()->route('admin.apartments.show', $newApartment);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $now = Carbon::now();
        // Reviews Avarage
        $numreviews = 0;
        $rating = 0;
        $numvotes = 0;
        foreach ($apartment->reviews as $review) {
            $numreviews++;  
            $numvotes++;
            $rating += $review->rating;
        }
        if ($numvotes != 0) {
            $fullaverage = $rating / $numvotes;
            $average = round($fullaverage, 2);
        }
        elseif ($numvotes == 0) {
            $fullaverage = 0;
            $average = 0;
        }

        return view('admin.apartments.show', compact('apartment', 'now', 'average', 'numvotes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        $categories = Category::all();
        $media = $apartment->media;
        $active_services = $apartment->services();
        return view('admin.apartments.edit', compact('services', 'categories', 'apartment', 'media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        // Todo: Add validations via validationRules() references

        $data = $request->all();

        $data['user_id'] = Auth::id();

        // Delete stored img if any other featured img was uploaded
        if(!empty($data['featured_img']) && $data['feat_img_to_delete']) {
            Storage::disk('public')->delete($apartment->featured_img);
            $data['featured_img'] = Storage::disk('public')->put('images', $data['featured_img']);
        }

        $updated = $apartment->update($data);

        if($updated) {
            if(empty($data['services'])) {
                $apartment->services()->detach();
            } else {
                $apartment->services()->sync($data['services']);
            }
        }

        
        $mediaStored = Media::all()->where('apartment_id', $apartment->id);
        
        if(empty($mediaStored)) {

            foreach($data['media'] as $path) {
                if($counter < $this->maxPathImg) {
                    $path = Storage::disk('public')->put('images', $path);
                    $newMedia = new Media();
                    $newMedia->apartment_id = $apartment->id;
                    $newMedia->path = $path;
                    $newMedia->type = 'img';
                    $newMedia->save();
                    $counter++;
                } else {
                    break;
                }
            }

        } else {
            
            if(!empty($data['media_to_delete'])) {
                foreach($data['media_to_delete'] as $media_id) {
                    $media_to_delete = Media::find($media_id);
                    Storage::disk('public')->delete($media_to_delete->featured_img);
                    Media::find($media_id)->delete();
                }
            }

            if(!empty($data['media'])) {

                $counter = count($apartment->media);

                foreach($data['media'] as $path) {
                    if($counter < $this->maxPathImg) {
                        $path = Storage::disk('public')->put('images', $path);
                        $newMedia = new Media();
                        $newMedia->apartment_id = $apartment->id;
                        $newMedia->path = $path;
                        $newMedia->type = 'img';
                        $newMedia->save();
                        $counter++;
                    } else {
                        break;
                    }
                }
            }
        }

        return redirect()->route('admin.apartments.show', $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if(empty($apartment)) {
            abort(404);
        }

        $deleted_apartment = $apartment->title;

        $apartment->services()->detach();
        $apartment->sponsor_plans()->detach();
        $apartment->messages()->delete();
        $apartment->reviews()->delete();

        $media_to_delete = Media::where('apartment_id', $apartment->id)->get();

        foreach($media_to_delete as $item) {
            Storage::disk('public')->delete($item->path);
            Media::find($item->id)->delete();
        }

        $deleted = $apartment->delete();

        if($deleted) {
            return redirect()->route('admin.apartments.index')->with('deleted_apartment', $deleted_apartment);
        }
    }

    public function toggle(Apartment $apartment)
    {
        if($apartment->active == 0) {
            $apartment->active = 1;
        } else {
            $apartment->active = 0;
        }
        
        $updated = $apartment->update();

        if($updated) {
            return redirect()->route('admin.apartments.index');
        }
    }

    /**
     * Validation rules.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function validationRules($id = null)
    {
        return [
            'user_id'          => 'required|numeric',
            'title'            => 'required|string|max:255',
            'description'      => 'required|string|max:255',
            'rooms_number'     => 'required|string|max:255',
            'beds_number'      => 'required|max:200',
            'bathrooms_number' => 'required|max:200',
            'square_meters'    => 'required|max:200',
        ];
    }
}
