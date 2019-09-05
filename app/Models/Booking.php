<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'schedule_id', 'booking_code', 'user_id','qty','total','status','available_until'
    ];

    public function schedule()
    {
            return $this->belongsTo('App\Models\Schedule', 'schedule_id');
    }

    public function user()
    {
            return $this->belongsTo('App\User', 'user_id');
    }

    
}
