<?php

use Illuminate\Database\Seeder;

use App\Apartment;
use App\Category;
use App\Media;
use App\User;
use Faker\Generator as Faker;

class ApartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        $apartment = 60;
        $users = User::all();
        $categories = Category::all();

        $data_apartments = config('data-apt');
        foreach($data_apartments as $item) {
            $newApartment = new Apartment();
            $newApartment->user_id          = $faker->numberBetween(1, 2);
            $newApartment->title            = $item['title'];
            $newApartment->description      = $item['description'];
            $newApartment->category_id      = $item['category_id'];
            $newApartment->rooms_number     = $item['rooms_number'];
            $newApartment->beds_number      = $item['beds_number'];
            $newApartment->bathrooms_number = 3;
            $newApartment->square_meters    = $item['square_meters'];
            $newApartment->country          = $item['country'];
            $newApartment->region           = $item['region'];
            $newApartment->province         = $item['province'];
            $newApartment->city             = $item['city'];
            $newApartment->address          = $item['address'];
            $newApartment->zip_code         = $item['zip_code'];
            $newApartment->geo_lat          = $item['geo_lat'];
            $newApartment->geo_lng          = $item['geo_lng'];
            $newApartment->active           = true;
            $newApartment->views            = $faker->numberBetween(5, 50);
            $newApartment->featured_img     = $item['featured_img'];
            $newApartment->save();

            foreach($item['media'] as $path) {
                $newMedia = new Media();
                $newMedia->apartment_id = $newApartment->id;
                $newMedia->path = $path;
                $newMedia->type = 'img';
                $newMedia->save();
            }
        } 

        for ($i=0 ; $i < $apartment  ; $i++ ) { 

            $newApartament = new Apartment();
            $newApartament->user_id = $users->random()->id;
            $newApartament->category_id = $categories->random()->id;
            $newApartament->title = $faker->text(30);
            $newApartament->description = $faker->text();
            $newApartament->rooms_number = rand(1,5);
            $newApartament->beds_number = rand(1,8);
            $newApartament->bathrooms_number = rand(1,3);
            $newApartament->square_meters = rand(50, 200);
            $newApartament->country = $faker->country();
            $newApartament->region = $faker->state();
            $newApartament->province = $faker->state();
            $newApartament->city = $faker->city();
            $newApartament->address = $faker->streetAddress();
            $newApartament->zip_code = $faker->postcode();
            $newApartament->geo_lat = $faker->latitude();
            $newApartament->geo_lng = $faker->longitude();
            $newApartament->active = true;
            $newApartament->views = $faker->numberBetween(5, 50);
            $newApartament->featured_img = $faker->imageUrl();
            $newApartament->save();
        }
    }
}
