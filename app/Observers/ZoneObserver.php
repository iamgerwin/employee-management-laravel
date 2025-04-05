<?php

namespace App\Observers;

use App\Models\Zone;
use Illuminate\Support\Str;

class ZoneObserver
{
    public function creating(Zone $zone): void
    {
        $zone->id = (string) Str::uuid();
    }
}
