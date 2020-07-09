<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Apartment;
use App\Service;

class ApartmentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();
        $services = Service::all();

        foreach($apartments as $apartment) {
            foreach($services as $service) {
                $faker->boolean(20) ?: $apartment->services()->attach($service->id);
            }
        }
    }
}
