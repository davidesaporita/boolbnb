<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            CategoryTableSeeder::class,
            ServiceTableSeeder::class,
            SponsorPlanTableSeeder::class,
            ApartmentTableSeeder::class,
            InfoRequestTableSeeder::class,
            MediaTableSeeder::class,
            ReviewTableSeeder::class,
            ApartmentServiceTableSeeder::class,
            SponsorshipTableSeeder::class,
            StatTypeTableSeeder::class,
            StatTableSeeder::class
        ]);
    }
}
