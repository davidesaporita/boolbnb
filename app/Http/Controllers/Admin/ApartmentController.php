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
use App\Message;
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
        return redirect()->route('admin.index');
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
        // Validation
        $request->validate($this->validationRules());

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

            return redirect()->route('apartments.show', $newApartment);
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
        // Policy check
        $this->authorize('view', $apartment);

        return redirect()->route('apartments.show', $apartment->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        // Policy check
        $this->authorize('update', $apartment);

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
        // Policy check
        $this->authorize('update', $apartment);

        // Validation
        $request->validate($this->validationRules());

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

        return redirect()->route('apartments.show', $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        // Policy check
        $this->authorize('delete', $apartment);
        
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
            return redirect()->route('admin.index')->with('deleted_apartment', $deleted_apartment);
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
            return redirect()->route('apartments.show', compact('apartment'));
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
            'title'            => 'required|string|min:3|max:80',
            'category_id'      => 'required|numeric|exists:categories,id',
            'description'      => 'required|string|min:10|max:1000',
            'rooms_number'     => 'required|numeric|min:1|max:50',
            'beds_number'      => 'required|numeric|min:1|max:50',
            'bathrooms_number' => 'required|numeric|min:1|max:50',
            'square_meters'    => 'required|numeric|min:1|max:1000',
            'address'          => 'required|min:2|max:100',
            'country'          => 'required|string|max:50',
            'region'           => 'required|string|max:50',
            'city'             => 'required|string|max:50',
            'geo_lat'          => 'required|numeric|between:-90,90',
            'geo_lng'          => 'required|numeric|between:-180,180',
            'services'         => 'exists:services,id',
            'featured_img'     => 'file|image|mimes:jpeg,bmp,png|max:2048',
            'media.*'          => 'file|image|mimes:jpeg,bmp,png|max:2048'
        ];
    }
}
