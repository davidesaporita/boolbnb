<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [ 'WiFi',           'fas fa-wifi' ],
            [ 'Posto Macchina', 'fas fa-car'],
            [ 'Piscina',        'fas fa-swimming-pool'],
            [ 'Portineria',     'fas fa-bell'],
            [ 'Sauna',          'fas fa-hot-tub'],
            [ 'Vista Mare',     'fas fa-water']
        ];
        foreach ($services as $service) {
            $newService = new Service();
            $newService->name = $service[0];
            $newService->icon = $service[1];
            $newService->save();
        }
    }
}
