<?php

namespace App\Observers;

use App\Models\Country;
use Illuminate\Support\Str;

class CountryObserver
{
    public function creating(Country $country): void
    {
        $country->id = (string) Str::uuid();
    }

    /**
     * Handle the Country "created" event.
     */
    public function created(Country $country): void
    {
        //
    }

    /**
     * Handle the Country "updated" event.
     */
    public function updated(Country $country): void
    {
        //
    }

    /**
     * Handle the Country "deleted" event.
     */
    public function deleted(Country $country): void
    {
        //
    }

    /**
     * Handle the Country "restored" event.
     */
    public function restored(Country $country): void
    {
        //
    }

    /**
     * Handle the Country "force deleted" event.
     */
    public function forceDeleted(Country $country): void
    {
        //
    }
}
