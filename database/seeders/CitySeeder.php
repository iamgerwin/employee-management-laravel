<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = State::all()->keyBy('code');

        $cities = [
            // Metro Manila cities
            ['name' => 'Manila', 'state_id' => $states['NCR']->id],
            ['name' => 'Quezon City', 'state_id' => $states['NCR']->id],
            
            // Cebu cities
            ['name' => 'Cebu City', 'state_id' => $states['CEB']->id],
            
            // Davao cities
            ['name' => 'Davao City', 'state_id' => $states['DAV']->id],
            
            // Central Luzon cities
            ['name' => 'Angeles', 'state_id' => $states['CL']->id],
        ];

        foreach ($cities as $city) {
            City::firstOrCreate(
                ['name' => $city['name'], 'state_id' => $city['state_id']],
                $city
            );
        }
    }
}
