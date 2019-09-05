<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id', 'bank_id', 'bank_from','account_number','account_name',
        'payment_transfer','images'
    ];

    public function bank()
    {
            return $this->belongsTo('App\Models\Bank', 'bank_id');
    }

    public function booking()
    {
            return $this->belongsTo('App\Models\Booking', 'booking_id');
    }

    public function notHavingImageInDb(){
        return (!empty($this->images))?true:false;
        //return true;
    }
}
