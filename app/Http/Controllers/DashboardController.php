<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, DB;
use App\Models\{Route, Payment, Schedule, Booking};
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified','userLevelMiddleware']);
    }
    
    public function dashboard()
    {
        return view('admin.index');
    }

    public function deleteNotification($notification)
    {
        $notification = Auth::user()->notifications()->where('id',$notification)->first();
        if ($notification)
        {
            $notification->delete();
            return back();
        }
        else
            return back()->withErrors('we could not found the specified notification');
    }

    public function report()
    {
        $departure=Route::distinct()->get(['departure']);                //data kota asal
        $destination =Route::distinct()->get(['destination']);            //data kota tujuan
        return view('report.form', compact('departure','destination'));
    }

    public function reportResult(Request $request)
    {
       
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $departure = $request->departure;
        $destination = $request->destination;

        if($departure == '0' && $destination == '0')
        {
            $payment = Payment::whereBetween('created_at',[$start_date, $end_date])->get(); 
        }
        if($departure != '0' && $destination == '0')
        {
            $route = Route::where('departure', $departure)->get()->pluck('id');               //mencari kota berangkat
            $schedule = Schedule::whereRaw('route_id', $route)->get()->pluck('id');              //mencari jadwal
            $booking = Booking::where('status', 2)->whereRaw('schedule_id', $schedule)->get()->pluck('id');    // mencari booking
            $payment = Payment::whereBetween('created_at',[$start_date, $end_date])->whereRaw('booking_id', $booking)->sum();
        }
        if($departure == '0' && $destination != '0')
        {
            $route = Route::where('destination', $destination)->get()->pluck('id'); //mencari kota tujuan
            $schedule = Schedule::where('route_id', $route)->get()->pluck('id'); //mencari jadwal
            $booking = Booking::where('status', 2)->where('schedule_id', $schedule)->get()->pluck('id'); // mencari booking
            $payment = Payment::whereBetween('created_at',[$start_date, $end_date])->where('booking_id', $booking)->get();
        }

        if($departure != '0' && $destination != '0')
        {
            $route = Route::where('departure', $departure)->where('destination', $destination)->get()->pluck('id');         //mencari kota

            $schedule = Schedule::where('route_id',$route)->get()->pluck('id');                                             //mencari jadwal
            $booking = Booking::where('status', 2)->where('schedule_id', $schedule)->get()->pluck('id');                    // mencari booking
            $payment = Payment::whereBetween('created_at',[$start_date, $end_date])->where('booking_id', $booking)->get();
        }

        return view('report.result', compact('payment','start_date','end_date','departure','destination'));
    }

    public function member()
    {
        $member = User::where('level',0)->get();
        return view ('member.index', compact('member'));
    }
    
}
