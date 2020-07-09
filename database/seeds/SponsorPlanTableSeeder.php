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
        $basicPlan->hours = '24';
        $basicPlan->price = 2.99;
        $basicPlan->save();
        // Medium Plan
        $mediumPlan = new  SponsorPlan();
        $mediumPlan->name = 'medium';
        $mediumPlan->hours = '72';
        $mediumPlan->price = 5.99;
        $mediumPlan->save();
        // Top Plan
        $topPlan = new  SponsorPlan();
        $topPlan->name = 'top';
        $topPlan->hours = '144';
        $topPlan->price = 9.99;
        $topPlan->save();
        
    }
}
