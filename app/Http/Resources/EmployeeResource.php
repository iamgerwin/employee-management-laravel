<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'zone' => $this->zone->only(['id', 'name']),
            'city' => $this->city->only(['id', 'name']),
            'state' => $this->state->only(['id', 'name']),
            'country' => $this->country->only(['id', 'name']),
            'departments' => $this->departments->map(function ($department) {
                return $department->only(['id', 'name']);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
