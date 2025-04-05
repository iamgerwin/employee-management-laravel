<?php

namespace App\Observers;

use App\Models\City;
use Illuminate\Support\Str;

class CityObserver
{
    public function creating(City $city): void
    {
        $city->id = (string) Str::uuid();
    }
}
