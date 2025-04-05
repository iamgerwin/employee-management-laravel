<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasUuids;

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
