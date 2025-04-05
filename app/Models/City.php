<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasUuids;
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'state_id',
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }
}
