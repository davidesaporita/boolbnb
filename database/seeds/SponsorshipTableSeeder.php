<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;

use App\Apartment;
use App\SponsorPlan;

class SponsorshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach(Apartment::all() as $apartment) {
            foreach(SponsorPlan::all() as $plan) {                

                // Todo : improve query using many to many way 
                $active_sponsorships = count(DB::table('sponsorships')->where('apartment_id', $apartment->id)->get());

                if($faker->boolean(20) && $active_sponsorships == 0) {

                    $start = Carbon::now();
                    $deadline = $start->copy()->addHours($plan->hours);

                    $data = [
                        'transaction_id' => $faker->bothify('??##?#?#'),
                        'amount'         => $plan->price,
                        'start'          => $start,
                        'deadline'       => $deadline
                    ];

                    $apartment->sponsor_plans()->attach($plan->id, $data);
                } 
            }
        }
    }
}
