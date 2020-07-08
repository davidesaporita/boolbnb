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
        $apartments = Apartment::all();

        foreach( $apartments as $appartment ) {
            for ( $i = 0; $i < 4; $i++ ) {
                if ( $faker->boolean(30) ) {
                    $newInfoRequest = new InfoRequest();
                    $newInfoRequest->apartment_id = $appartment->id;
                    $newInfoRequest->email = $faker->email();
                    $newInfoRequest->title = $faker->text(50);
                    $newInfoRequest->body = $faker->text(400);
                    $newInfoRequest->save();
                }
            }
        }
    }
}
