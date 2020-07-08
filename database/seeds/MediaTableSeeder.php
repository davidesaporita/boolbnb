<?php

use App\Media;
use App\Apartment;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;



class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();

        foreach ( $apartments as $apartment ) {
            $newMedia = new Media();
            $newMedia->apartment_id = $apartments->id;
            $newMedia->path = $faker->imageUrl();
            $newMedia->type = 'img';
            $newMedia->caption = $faker->text(75);
            $newMedia->save();
        }
    }
}
