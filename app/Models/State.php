<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'code',
        'country_id',
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
