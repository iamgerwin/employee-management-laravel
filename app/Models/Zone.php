<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
