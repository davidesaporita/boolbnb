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

        for ($i = 0; $i < $users; $i++) {
            $newUser = new User();
            $newUser->first_name = $faker->firstName();
            $newUser->last_name  = $faker->lastName();
            $newUser->birth_date = $faker->date('Y-m-d', '2002-01-01');
            $newUser->email      = $i == 0 ? "admin@test.com" : $faker->email();
            $newUser->password   = Hash::make('password');
            $newUser->path_img   = asset('public/img/man-2.jpg');
            $newUser->gender     = $i == 0 ? 'm' : ($faker->boolean(50) ? 'm' : 'f');
            $newUser->save();       
        }
    }
}
