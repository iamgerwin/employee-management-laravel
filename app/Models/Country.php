<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ApiResource(
    routePrefix: '/v{version}',
    defaults: ['version' => '1'],
    operations: [
        new GetCollection(),
        new Post(),
        new Get(),
        new Put(),
        new Delete()
    ]
)]
class Country extends Model
{
    use HasUuids;
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'code',
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
