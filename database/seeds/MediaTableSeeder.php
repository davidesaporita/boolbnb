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
        $max_img_number = 6;

        foreach ( $apartments as $apartment ) {
            for($i = 0; $i < $max_img_number; $i++) {
                if($faker->boolean(60)) {
                    $newMedia = new Media();
                    $newMedia->apartment_id = $apartment->id;
                    $newMedia->path = $faker->imageUrl(640, 480);
                    $newMedia->type = 'img';
                    $newMedia->caption = $faker->text(75);
                    $newMedia->save();
                }
            }
        }
    }
}
