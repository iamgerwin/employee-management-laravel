<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'zone_id' => 'required|exists:zones,id',
            'city_id' => 'required|exists:cities,id',
            'state_id' => 'required|exists:states,id',
            'country_id' => 'required|exists:countries,id',
            'department_ids' => 'required|array',
            'department_ids.*' => 'exists:departments,id'
        ];
        
        if ($this->isMethod('post')) {
            $rules['email'] = 'required|email|unique:employees,email';
            $rules['password'] = 'required|string|min:8';
        } else {
            $employeeId = $this->route('employee') ? $this->route('employee')->id : '';
            $rules['email'] = 'sometimes|email|unique:employees,email,'.$employeeId;
            $rules['password'] = 'sometimes|string|min:8';
            
            // Make fields optional for update
            $optionalFields = ['zone_id', 'city_id', 'state_id', 'country_id', 'department_ids'];
            foreach ($optionalFields as $field) {
                $rules[$field] = str_replace('required|', 'sometimes|', $rules[$field]);
            }
        }
        
        return $rules;
    }
}
