<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    routePrefix: '/v{version}',
    defaults: ['version' => '1'],
    operations: [
        new GetCollection(),
        new Post(),
        new Get(),
        new Put(),
        new Patch(),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['employee:read']],
    denormalizationContext: ['groups' => ['employee:write']],
)]
class Employee extends Model
{
    use HasFactory;
    use HasUuids;

    #[Groups(['employee:read', 'employee:write'])]
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'zone_id',
        'city_id',
        'state_id',
        'country_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    #[Groups(['employee:read'])]
    public function getDepartments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'employee_department');
    }

    public function department(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'employee_department');
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'employee_department');
    }
}
