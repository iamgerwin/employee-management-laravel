<?php

namespace App\Observers;

use App\Models\State;
use Illuminate\Support\Str;

class StateObserver
{
    public function creating(State $state): void
    {
        $state->id = (string) Str::uuid();
    }
}
