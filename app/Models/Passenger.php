<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $fillable = [
        'booking_id','name','identity','seat'
    ];

    public function booking()
    {
            return $this->belongsTo('App\Models\Booking', 'booking_id');
    }
}
