<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use App\Models\User;
use App\Models\Zone;
use App\Observers\CityObserver;
use App\Observers\CountryObserver;
use App\Observers\DepartmentObserver;
use App\Observers\EmployeeObserver;
use App\Observers\StateObserver;
use App\Observers\UserObserver;
use App\Observers\ZoneObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Country::observe(CountryObserver::class);
        City::observe(CityObserver::class);
        Department::observe(DepartmentObserver::class);
        Employee::observe(EmployeeObserver::class);
        State::observe(StateObserver::class);
        Zone::observe(ZoneObserver::class);
    }
}
