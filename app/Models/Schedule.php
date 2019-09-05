<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'car_id', 'route_id', 'driver_id','date_departure','seat','price','status'
    ];

    public function car()
    {
            return $this->belongsTo('App\Models\Car', 'car_id');
    }

    public function route()
    {
            return $this->belongsTo('App\Models\Route', 'route_id');
    }

    public function driver()
    {
            return $this->belongsTo('App\Models\Driver', 'driver_id');
    }
}