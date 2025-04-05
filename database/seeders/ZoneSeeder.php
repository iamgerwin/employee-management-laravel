<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have at least one zone per city
        City::all()->each(function($city) {
            if (!Zone::where('city_id', $city->id)->exists()) {
                Zone::factory()->create([
                    'city_id' => $city->id,
                    'name' => $city->name . ' Central'
                ]);
            }
        });

        // Add additional zones for major cities
        $majorCities = City::whereIn('name', ['Manila', 'Cebu City', 'Davao City'])->get();
        
        foreach ($majorCities as $city) {
            Zone::factory()->count(3)->create(['city_id' => $city->id]);
        }
    }
}
