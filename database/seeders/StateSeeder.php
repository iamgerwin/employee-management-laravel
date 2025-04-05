<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = Country::all()->keyBy('code');

        foreach ($this->getStates($countries) as $state) {
            State::firstOrCreate(
                ['name' => $state['name'], 'country_id' => $state['country_id']],
                $state
            );
        }
    }

    protected function getStates($countries): array
    {
        return [
            // Philippines
            ['name' => 'Metro Manila', 'code' => 'NCR', 'country_id' => $countries['PH']->id],
            ['name' => 'Cebu', 'code' => 'CEB', 'country_id' => $countries['PH']->id],
            ['name' => 'Davao', 'code' => 'DAV', 'country_id' => $countries['PH']->id],
            ['name' => 'Central Luzon', 'code' => 'CL', 'country_id' => $countries['PH']->id],
            
            // Other countries
            ['name' => 'California', 'code' => 'CA', 'country_id' => $countries['US']->id],
            ['name' => 'Texas', 'code' => 'TX', 'country_id' => $countries['US']->id],
            ['name' => 'Ontario', 'code' => 'ON', 'country_id' => $countries['CA']->id],
            ['name' => 'England', 'code' => 'ENG', 'country_id' => $countries['GB']->id],
        ];
    }
}
