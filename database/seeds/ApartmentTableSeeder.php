<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Category;
use App\Apartment;
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
        $apartment = 45;
        $users = User::all();
        $categories = Category::all();

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
            $newApartament->address = $faker->address();
            $newApartament->geo_lat = $faker->latitude();
            $newApartament->geo_lon = $faker->longitude();
            $newApartament->active = true;
            $newApartament->views = $faker->numberBetween(5, 50);
            $newApartament->featured_img = $faker->imageUrl();

            $newApartament->save();
        }
    }
}
