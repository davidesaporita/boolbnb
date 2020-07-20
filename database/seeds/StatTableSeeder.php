<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;

use App\Apartment;
use App\Stat;
use App\StatType;

class StatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // 

        foreach(Apartment::all() as $apartment) {
            foreach(StatType::all() as $type) {
                if($type->name == 'view') {
                    $num = rand(10, 300);
                } else {
                    $num = rand(0, 30);
                }

                for($i = 0; $i < $num; $i++) {
                    $datetime = $faker->dateTimeBetween('2020-01-01', 'now');

                    $newStat = new Stat();
                    $data = [
                        'apartment_id' => $apartment->id,
                        'stat_type_id' => $type->id,
                        'created_at'   => $datetime,
                        'updated_at'   => $datetime
                    ];
                    $newStat->fill($data);
                    $newStat->save();
                }
            }
        }
    }
}
