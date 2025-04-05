<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zone;
use Database\Seeders\CountrySeeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\ZoneSeeder;
use Database\Seeders\DepartmentSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed core data first
        $this->call([
            CountrySeeder::class,
        ]);

        // Seed locations in order
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(ZoneSeeder::class);

        // Seed departments
        $this->call(DepartmentSeeder::class);

        // Only create employees if we have all required data
        if (\App\Models\Country::where('code', 'PH')->exists() && 
            \App\Models\State::exists() && 
            \App\Models\City::exists() && 
            \App\Models\Zone::exists()) {
            \App\Models\Employee::factory(10)->create();
        } else {
            $this->command->error('Skipping employee creation - missing required location data');
        }

        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
