<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneFactory extends Factory
{
    protected $model = Zone::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'city_id' => City::factory(),
        ];
    }
}
