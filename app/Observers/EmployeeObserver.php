<?php

namespace App\Observers;

use App\Models\Employee;
use Illuminate\Support\Str;

class EmployeeObserver
{
    public function creating(Employee $employee): void
    {
        $employee->id = (string) Str::uuid();
    }
}
