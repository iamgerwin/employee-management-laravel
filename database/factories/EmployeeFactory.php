<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        // Get random country or use PH as default
        $phCountry = Country::where('code', 'PH')->firstOrFail();
        
        // Get random state or create one if none exists
        $state = State::where('country_id', $phCountry->id)->inRandomOrder()->firstOrFail() ?? 
            State::factory()->create(['country_id' => $phCountry->id]);
            
        // Get random city or create one if none exists
        $city = City::where('state_id', $state->id)->inRandomOrder()->firstOrFail() ?? 
            City::factory()->create(['state_id' => $state->id]);
            
        // Get random zone or create one if none exists
        $zone = Zone::where('city_id', $city->id)->inRandomOrder()->firstOrFail() ?? 
            Zone::factory()->create(['city_id' => $city->id]);
            
        // Get random department or create one if none exists
        $department = Department::inRandomOrder()->first() ?? 
            Department::factory()->create();

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'phone' => '+639' . $this->faker->numerify('#########'),
            'country_id' => $phCountry->id,
            'state_id' => $state->id,
            'city_id' => $city->id,
            'zone_id' => $zone->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Employee $employee) {
            $departments = Department::all();
            if ($departments->isNotEmpty()) {
                $employee->departments()->attach($departments->random());
            }
        });
    }
}
