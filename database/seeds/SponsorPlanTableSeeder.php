<?php

use Illuminate\Database\Seeder;
use App\SponsorPlan;

class SponsorPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Plans
        $sponsorPlans = [
            [
                'name' => 'basic', 
                'hours' => 24,
                'price' => 2.99
            ],
            [
                'name' => 'medium', 
                'hours' => 72,
                'price' => 5.99
            ],
            [
                'name' => 'top', 
                'hours' => 144,
                'price' => 9.99
            ]
        ];
        foreach ($sponsorPlans as $sponsorPlan) {
            $plan = new SponsorPlan();
            $plan->name = $sponsorPlan['name'];
            $plan->hours = $sponsorPlan['hours'];
            $plan->price = $sponsorPlan['price'];
            $plan->save();    
        }
    }
}
