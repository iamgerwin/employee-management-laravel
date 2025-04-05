<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
