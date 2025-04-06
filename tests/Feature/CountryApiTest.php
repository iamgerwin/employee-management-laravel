<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CountryApiTest extends TestCase
{
    use RefreshDatabase;

    protected $country;

    protected function setUp(): void
    {
        parent::setUp();
        $this->country = Country::factory()->create();
    }

    #[Test]
    public function it_can_list_all_countries()
    {
        Country::factory()->count(3)->create();
        
        $response = $this->getJson('/api/countries');
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'code', 'created_at', 'updated_at']
                ],
                'meta' => ['version', 'api']
            ])
            ->assertJsonCount(4, 'data');
    }

    #[Test]
    public function it_can_create_a_country()
    {
        $data = [
            'name' => 'Test Country',
            'code' => 'TC'
        ];
        
        $response = $this->postJson('/api/countries', $data);
        
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => ['id', 'name', 'code', 'created_at', 'updated_at'],
                'meta' => ['version', 'api']
            ])
            ->assertJsonFragment(['name' => 'Test Country']);
        
        $this->assertDatabaseHas('countries', $data);
    }

    #[Test]
    public function it_validates_country_creation()
    {
        $response = $this->postJson('/api/countries', []);
        
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'code']);
    }

    #[Test]
    public function it_can_show_a_country()
    {
        $response = $this->getJson('/api/countries/' . $this->country->id);
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['id', 'name', 'code', 'created_at', 'updated_at'],
                'meta' => ['version', 'api']
            ])
            ->assertJsonFragment([
                'id' => $this->country->id,
                'name' => $this->country->name
            ]);
    }

    #[Test]
    public function it_returns_404_for_nonexistent_country()
    {
        $response = $this->getJson('/api/countries/00000000-0000-0000-0000-000000000000');
        
        $response->assertStatus(404);
    }

    #[Test]
    public function it_can_update_a_country()
    {
        $data = ['name' => 'Updated Name', 'code' => 'UN'];
        
        $response = $this->putJson('/api/countries/' . $this->country->id, $data);
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['id', 'name', 'code', 'created_at', 'updated_at'],
                'meta' => ['version', 'api']
            ])
            ->assertJsonFragment($data);
        
        $this->assertDatabaseHas('countries', array_merge(['id' => $this->country->id], $data));
    }

    #[Test]
    public function it_validates_country_updates()
    {
        $response = $this->putJson('/api/countries/' . $this->country->id, ['name' => '', 'code' => '']);
        
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'code']);
    }

    #[Test]
    public function it_can_delete_a_country()
    {
        $response = $this->deleteJson('/api/countries/' . $this->country->id);
        
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('countries', ['id' => $this->country->id]);
    }

    #[Test]
    public function it_returns_404_when_deleting_nonexistent_country()
    {
        $response = $this->deleteJson('/api/countries/00000000-0000-0000-0000-000000000000');
        
        $response->assertStatus(404);
    }
}
