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
        // Basic Plan
        $basicPlan = new  SponsorPlan();
        $basicPlan->name = 'basic';
        $basicPlan->hours = '24:00';
        $basicPlan->price = 2.99;
        $basicPlan->save();
        // Medium Plan
        $mediumPlan = new  SponsorPlan();
        $mediumPlan->name = 'medium';
        $mediumPlan->hours = '72:00';
        $mediumPlan->price = 5.99;
        $mediumPlan->save();
        // Top Plan
        $topPlan = new  SponsorPlan();
        $topPlan->name = 'top';
        $topPlan->hours = '144:00';
        $topPlan->price = 9.99;
        $topPlan->save();
        
    }
}
