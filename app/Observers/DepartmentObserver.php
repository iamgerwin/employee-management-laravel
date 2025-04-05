<?php

namespace App\Observers;

use App\Models\Department;
use Illuminate\Support\Str;

class DepartmentObserver
{
    public function creating(Department $department): void
    {
        $department->id = (string) Str::uuid();
    }
}
