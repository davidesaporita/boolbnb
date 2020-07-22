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
        $active_sponsorships_counter = 0;
        $max_active_sponsorships = 20; // Max for active sponsorships
        
        $sponsorships_counter = 0;
        $max_total_sponsorships = 40; // Max for all sponsorships (including active and expired ones)

        foreach(Apartment::all() as $apartment) {
            foreach(SponsorPlan::all() as $plan) {

                // Todo : change query using eloquent syntax (maybe creating a specific model?)
                $sponsorships = count(
                        DB::table('sponsorships')
                            ->where('apartment_id', $apartment->id)
                            ->get()
                        );
                
                if($faker->boolean(30) && $sponsorships_counter < $max_total_sponsorships) {
                    if($faker->boolean(70) && $active_sponsorships_counter < $max_active_sponsorships) {
                        $date = Carbon::instance($faker->dateTimeBetween('-20 hours', 'now', 'Europe/Rome'));
                        $active_sponsorships_counter++;
                    } else {
                        $date = Carbon::instance($faker->dateTimeBetween('-1 year', '-144 hours', 'Europe/Rome'));
                    }

                    $start = $date;
                    $deadline = $start->copy()->addHours($plan->hours);

                    $data = [
                        'transaction_id' => $faker->bothify('??##?#?#'),
                        'amount'         => $plan->price,
                        'start'          => $start,
                        'deadline'       => $deadline
                    ];

                    $apartment->sponsor_plans()->attach($plan->id, $data);
                    $sponsorships_counter++;
                } 
            }
        }
    }
}
