<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'schedule_id','booking_id','number','status'
    ];

    public function schedule()
    {
            return $this->belongsTo('App\Models\Schedule', 'schedule_id');
    }

    public function seat($schedule_id)
    {
        return $this->where('schedule_id', $schedule_id)->where('status',0)->get();
    }
}
