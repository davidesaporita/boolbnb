<?php

use Illuminate\Database\Seeder;

use App\Apartment;
use App\Review;
use Faker\Generator as Faker;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $review = 50;
        $apartment = Apartment::all();

        for ($i=0; $i < $review ; $i++) { 

            $newReview = new Review();

            $newReview->apartment_id = $apartment->random()->id;
            $newReview->first_name   = $faker->firstName();
            $newReview->last_name    = $faker->lastName();
            $newReview->title        = $faker->text(10);
            $newReview->body         = $faker->text(200);
            $newReview->verified     = $faker->boolean(10) ? true : false;
            $newReview->rating       = rand(1,5);

            $newReview->save();
        }
    }
}
