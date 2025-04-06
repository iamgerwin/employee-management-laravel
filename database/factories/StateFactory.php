<?php

namespace Database\Factories;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class StateFactory extends Factory
{
    protected $model = State::class;

    public function definition()
    {
        return [
            'name' => $this->faker->state,
            'code' => $this->faker->stateAbbr,
            'country_id' => \App\Models\Country::factory(),
        ];
    }
}
