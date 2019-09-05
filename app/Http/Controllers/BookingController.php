<?php

namespace App\Http\Controllers;

use App\Models\{Booking, Payment, Passenger};
use Illuminate\Http\Request;
use Alert, Date, PDF, Mail;
use App\User;
use App\Mail\MailTicketNotify;
use App\Jobs\sendTicketEmail;
use Carbon\Carbon;



class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking = Booking::where(function($function) {
                    $function->where('status',0)
                        ->orWhere('status', 1)
                        ->orWhere('status', 2);
                })->get();
        return view('admin.booking.index', compact('booking'));
    }

    public function formVerificated($booking_code)
    {
        $booking = Booking::where('booking_code',$booking_code)->first();            //mencari data booking
        $payment = Payment::where('booking_id', $booking->id)->first();                 //menampilkan data pembayaran atas booking
        return view('admin.booking.formVerificated', compact('booking', 'payment'));
       
    }

    public function saveVerificated(Request $request, $booking_code)
    {
        if($request->verificated == "0")
        {
            Alert::error('Data Booking Belum Diverifikasi', 'Terjadi Keselahan');
            return back();
        }
        else
        {
            $booking = Booking::where('booking_code',$booking_code)->first();               //mencari data booking
            $booking->update([
                'status' => '2'
            ]);
   
                                                                                            //mendapatkan data penumpang
            $passenger= Passenger::where('booking_id', $booking->id)->get();
            
            //mendapatkkan email user
            // $email = User::where('id', $booking->user_id)->first();
            // //mendapatkan barcode
            // foreach($passenger as $passengers)
            // $barcode="Jadwal ". Date::parse($booking->schedule->route->time_departure)->format('H:i'). " ". Date::parse($booking->schedule->date_departure)->format('l, j F Y')." ,Asal ". $booking->schedule->route->departure. " ,Tujuan  ".$booking->schedule->route->destination." ,Harga ".$booking->schedule->price. " ,Nama Penumpang ". $passengers->name. " ,No Identitas ".$passengers->identity." ,No Seat ".$passengers->seat;

            // $pdf = PDF::loadview('homepage.eticket', compact('booking','passenger','barcode'))->setPaper('A4', 'potrait');

            //dispatch(new sendTicketEmail($pdf, $email));
            //Mail::to($email->email)->send(new MailTicketNotify($pdf));
            //$emailJob = (new sendTicketEmail($email))->delay(Carbon::now()->addSeconds(10));
            //dispatch($emailJob);
           // sendTicketEmail::dispatch($email, $pdf)
               // ->delay(now()->addSeconds(30));

            Alert::success('Status Booking Berhasil di Verifikasi','Sukses');
            return redirect()->route('data-booking');
        }
       
    }

}    