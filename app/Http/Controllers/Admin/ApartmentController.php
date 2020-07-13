<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

use App\Apartment;
use App\Category;
use App\Media;
use App\Service;

class ApartmentController extends Controller
{
    // Variables
    private $maxPathImg = 5;
    
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
        $apartments = Apartment::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.apartments.index', compact('apartments'));
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
        $data['views'] = 0;
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

        $active_sponsorship = DB::table('sponsorships')
            ->where('apartment_id', $apartment->id)
            ->where('deadline', '>', $now)
            ->get();

        return view('admin.apartments.show', compact('apartment', 'active_sponsorship'));
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

        dd($data);

        $data['user_id'] = Auth::id();

        // Delete stored img if any other featured img was uploaded
        if(!empty($data['featured_img'])) {
            Storage::disk('public')->delete($apartment->featured_img);
            $data['featured_img'] = Storage::disk('public')->put('images', $data['featured_img']);
        }

        if(!empty($data['media'])) {
            $mediaStored = Media::all()->where('id', $apartment->id);
            if(!empty($mediaStored)) {

            } else {
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
        }

        $data['featured_img'] = Storage::disk('public')->put('images', $data['featured_img']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
