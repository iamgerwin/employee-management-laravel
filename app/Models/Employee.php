<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;
    use HasUuids;

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

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'employee_department');
    }
}
