<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Human Resources',
            'Information Technology',
            'Finance',
            'Marketing',
            'Operations',
            'Sales',
            'Customer Support',
            'Research & Development',
            'Quality Assurance',
            'Administration',
        ];

        foreach ($departments as $departmentName) {
            Department::firstOrCreate(['name' => $departmentName]);
        }
    }
}
