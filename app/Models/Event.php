<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
        'days' => 'array',
//        'monday' => 'boolean',
//        'tuesday' => 'boolean',
//        'wednesday' => 'boolean',
//        'thursday' => 'boolean',
//        'friday' => 'boolean',
//        'saturday' => 'boolean',
//        'sunday' => 'boolean',
    ];
}

