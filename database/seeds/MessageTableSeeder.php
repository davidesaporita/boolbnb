<?php

use App\Message;
use App\Apartment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();

        foreach( $apartments as $apartment ) {
            for ( $i = 0; $i < 4; $i++ ) {
                if ( $faker->boolean(30) ) {
                    $newMessage = new Message();
                    $newMessage->apartment_id = $apartment->id;
                    $newMessage->email = $faker->email();
                    $newMessage->title = $faker->text(30);
                    $newMessage->body = $faker->text(400);
                    $newMessage->save();
                }
            }
        }
    }
}
