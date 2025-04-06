<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Zone;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone' => $this->faker->phoneNumber(),
            'zone_id' => Zone::factory(),
            'city_id' => City::factory(),
            'state_id' => State::factory(),
            'country_id' => Country::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Employee $employee) {
            $employee->departments()->attach(
                Department::factory()->count(2)->create()
            );
        });
    }
}
