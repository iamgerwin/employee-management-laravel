<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Zone;
use App\Models\Department;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return EmployeeResource::collection(
            Employee::with(['zone', 'city', 'state', 'country', 'departments'])->get()
        );
    }

    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $departmentIds = $validated['department_ids'];
        unset($validated['department_ids']);

        $employee = Employee::create($validated);
        $employee->departments()->sync($departmentIds);

        return new EmployeeResource($employee->load(['zone', 'city', 'state', 'country', 'departments']));
    }

    public function show(Employee $employee)
    {
        return new EmployeeResource($employee->load(['zone', 'city', 'state', 'country', 'departments']));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        if (isset($validated['department_ids'])) {
            $employee->departments()->sync($validated['department_ids']);
            unset($validated['department_ids']);
        }

        $employee->update($validated);

        return new EmployeeResource($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->noContent();
    }
}
