<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = 30;

        $defaultUser = new User();
        $defaultUser->first_name = $faker->firstName();
        $defaultUser->last_name = $faker->lastName();
        $defaultUser->birth_date = $faker->date('Y-m-d', '2002-01-01');
        $defaultUser->email = "admin@test.com";
        $defaultUser->password = Hash::make('password');
        $defaultUser->save();       

        for ($i = 0; $i < $users; $i++) {
            $newUser = new User();
            $newUser->first_name = $faker->firstName();
            $newUser->last_name = $faker->lastName();
            $newUser->birth_date = $faker->date('Y-m-d', '2002-01-01');
            $newUser->email = $faker->email();
            $newUser->password = Hash::make('password');
            $newUser->save();       
        }
    }
}
