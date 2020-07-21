<?php

use Illuminate\Database\Seeder;

use App\StatType;

class StatTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'view',         //1
            'message', //2
            'review',       //3
        ];

        foreach($types as $type) {
            $newStatType = new StatType();
            $newStatType->name = $type;
            $newStatType->save();
        }
    }
}
