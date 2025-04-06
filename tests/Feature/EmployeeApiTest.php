<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeApiTest extends TestCase
{
    use RefreshDatabase;

    protected Employee $employee;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->employee = Employee::factory()
            ->has(Department::factory()->count(2))
            ->create();
    }

    public function test_can_list_employees()
    {
        $response = $this->getJson('/api/v1/employees');
        
        $response->assertStatus(200);
        
        // Verify at least one employee is returned with expected fields
        $response->assertJsonCount(1);
        $response->assertJsonFragment([
            'name' => $this->employee->name,
            'email' => $this->employee->email
        ]);
    }

    public function test_can_create_an_employee()
    {
        $departments = Department::factory()->count(2)->create();
        $data = Employee::factory()->make()->toArray();
        $data['password'] = 'password';
        $data['department_ids'] = $departments->pluck('id')->toArray();
        
        $response = $this->postJson('/api/v1/employees', $data);
        
        $response->assertStatus(201)
            ->assertJsonFragment(['name' => $data['name']]);
        
        $this->assertDatabaseHas('employees', ['email' => $data['email']]);
    }

    public function test_can_show_an_employee()
    {
        $response = $this->getJson('/api/v1/employees/' . $this->employee->id);
        
        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $this->employee->id]);
    }

    public function test_can_update_an_employee()
    {
        $updated = ['name' => 'Updated Name'];
        
        $response = $this->putJson('/api/v1/employees/' . $this->employee->id, $updated);
        
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Name']);
        
        $this->assertDatabaseHas('employees', ['name' => 'Updated Name']);
    }

    public function test_can_delete_an_employee()
    {
        $response = $this->deleteJson('/api/v1/employees/' . $this->employee->id);
        
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('employees', ['id' => $this->employee->id]);
    }
}
