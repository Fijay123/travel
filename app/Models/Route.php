<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'departure', 'destination', 'time_departure','meeting_point',
        'status'
    ];
}
