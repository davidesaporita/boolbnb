<?php

use App\InfoRequest;
use App\Apartment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class InfoRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $infoRequests = 75;
        $apartments = Apartment::all();

        for ($i = 0; $i < $infoRequests; $i++) {

            $newInfoRequest = new InfoRequest();
            $newInfoRequest->apartment_id = $apartments->id;
            $newInfoRequest->email = $faker->email();
            $newInfoRequest->title = $faker->text(50);
            $newInfoRequest->body = $faker->text(400);
            $newInfoRequest->save();
            
        }
    }
}
