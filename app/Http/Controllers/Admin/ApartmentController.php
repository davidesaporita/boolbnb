<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use DB;

use App\Apartment;
use App\Service;
use App\Media;

class ApartmentController extends Controller
{
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
        dd($data);

        $data['user_id'] = Auth::id();
        $data['category_id'] = 1;

        $newApartament = new Apartment();
        $newApartament->fill($data);
        $saved = $newApartment->save();
        
        if($saved) {
            if(!empty($data['services'])) {
                $newApartament->services()->attach($data['services']);
            }
            if(!empty($data['path'])) {
                $newMedia = new Media();
                foreach($data['path'] as $path) {
                    $path = Storage::disk('public')->put('images', $path);
                    $newMedia->apartment_id = $newApartment->id();
                    $newMedia->path = $path;
                    $newMedia->type = 'img';
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
