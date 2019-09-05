<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Route, Schedule, Seat, Booking, Passenger, Bank, Payment};
use Session, Carbon, Str, Alert, Auth, Storage, Date, PDF, DNS2D, Mail, Notification;
use App\Http\Requests\{BookingRequest, PaymentRequest, PassengerRequest};
use App\Mail\MailBookingNotify;
use App\Mail\MailPaymentNotify;
use App\User;
use App\Notifications\PaymentNotification;





class FrontController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $departure=Route::distinct()->get(['departure']);                               //data kota asal
        $destination = Route::distinct()->get(['destination']);                             //data kota tujuan
        return view('homepage.index', compact('departure','destination'));
    }

    public function schedule(Request $request)
    {
              
        //validasi tanggal
        request()->validate([
            'date' => 'required',
        ],
        [
            'date.required' => 'Tanggal Keberangkatan Harus Di Isi !',
        ]);

        //cek input tanggal lampau
        
        $current = carbon\Carbon::now();
        $tomorrow = carbon\Carbon::tomorrow()->format('Y-m-d');
        $available = $current->addDays(7)->format('Y-m-d');

        if($request->date < $tomorrow)
        {
           Alert::error('Tanggal Sudah Tidak Berlaku','Terjadi Kesalahan!');
           return back();
        }
        elseif ($request->date > $available)
        {
            Alert::error('Tanggal Belum Tersedia','Terjadi Kesalahan!');
           return back();
        }
        else
        {
                                                                    //mendapatkan data rute
            $route = Route::where('departure', $request->departure)
            ->where('destination', $request->destination)
            ->pluck('id')
            ->toArray();
                                                                     //mendapatkan data jadwal    
            $schedule = Schedule::where('route_id', $route)
                        ->where('date_departure', $request->date)
                        ->where('status', 1)                         //status aktif
                        ->get();
            
                                                                    //mendapatkan tanggal
            $date= $request->date;
                                                                    //mendapatkan jumlah penumpang
            $passenger = $request->passenger;
                                                                                               //mendapatkan sisa kursi
            $seat = new Seat;
            return view('homepage.schedule', compact('schedule','date','passenger','seat'));
        }
    }

    public function scheduleInfo(Request $request,Schedule $schedule)
    {
                                                                            //menyimpan session jumlah penumpang
        Session::put('passenger', $request->passenger);
        return view('homepage.scheduleInfo', compact('schedule'));
    }

    public function bookingForm(Schedule $schedule)
    {
                                                                             //menampilkan data kursi yang tersedia
        $seat = Seat::where('status',0)
                ->where('schedule_id', $schedule->id)
                ->get();
        return view('homepage.bookingForm', compact('schedule','seat'));
    }

    public function bookingSave(PassengerRequest $request, Schedule $schedule)
    {
        $now=Carbon\Carbon::now(); //mendapatkan datetime sekarang
        $available_until = $now->addMinutes(60); //datetime sekarang ditambah 60 menit
        $getUser= auth()->user(); //mendapatkan id user
        $total = ($schedule->price * Session::get('passenger')) + random_int(100, 999) ; //mendapatkan nilai total harga

        //simpan data booking
        $booking = Booking::create([
            'schedule_id' => $schedule->id,
            'booking_code' => Str::random(6) ,
            'user_id' => $getUser->id,
            'qty' => Session::get('passenger'),
            'total' => $total,
            'available_until' => $available_until
            ]);

        //simpan data penumpang
        for($i = 0; $i < Session::get('passenger'); $i++)
        {    
            $passenger = Passenger::create([
                'booking_id' => $booking->id,
                'name' => $request->names[$i],
                'identity' => $request->identity[$i],
                'seat' => $request->seat[$i],
                ]);
        }

        //simpan data seat yang dibooking
        for($i = 0; $i < Session::get('passenger'); $i++)
        {
           $getSeat= Seat::where('id', $request->seat[$i])
                        ->first();
            $getSeat->update([
                'status' => '1',
                'booking_id' => $booking->id
            ]);
        }

        // $updateSeat = $schedule->seat - Session::get('passenger'); //mendapatkan update seat

        // //update jumlah seat
        // $schedule->update([
        //     'seat' => $updateSeat
        // ]);

        
        Session::forget('passenger'); //hapus session jumlah penumpang

          //mengirim email informasi booking
          Mail::to($getUser->email)->send(new MailBookingNotify($getUser,$booking));
    
        Alert::success('Data Booking Berhasil Di Simpan, Silahkan Segera Melakukan Pembayaran', 'Sukses');
        return redirect()->route('dataBooking', Auth::user()->id);
    }

    public function dataBooking()
    {
        $now=Carbon\Carbon::now(); //mendapatkan waktu sekarang
        $getUser = Auth::user()->id; //mendapatkan id user yang login
        $booking = Booking::where('user_id', $getUser)->get();
        return view('homepage.dataBooking', compact('booking', 'now'));
    }

    public function dataPassenger($booking_code)
    {
        $booking = Booking::where('booking_code', $booking_code)->first(); //mendapatkan data booking
        $passenger = Passenger::where('booking_id', $booking->id)->get(); //mendapatkan data penumpang
        return view('homepage.dataPassenger', compact('booking','passenger'));
    }

    public function updatePassenger(Request $request, $booking_code)
    {
        $booking = Booking::where('booking_code', $booking_code)->first(); //mendapatkan data booking
        $passenger = Passenger::where('booking_id', $booking->id)->get(); //mendapatkan data penumpang

        for($i = 0; $i<$passenger->count(); $i++)
        {
             $getPassenger =Passenger::find($request->id[$i]); //mencari id penumpang
             $getPassenger->update([
                 'name' => $request->name[$i],
                 'identity' => $request->identity[$i],
             ]);
         }
       
         Alert::success('Data Berhasil Diperbaharui','sukses');
        return back();
    }

    public function formConfirmation($booking_code)
    {
        $booking = Booking::where('booking_code', $booking_code)->first(); //mendapatkan data booking
        $bank = Bank::all(); //menampilkan data bank
        $payment = Payment::where('booking_id', $booking->id)->first();
        return view('homepage.formConfirmation', compact('booking', 'bank','payment'));
    }

    public function saveConfirmation(PaymentRequest $request)
    {

        if($request->price != $request->transfer)
        {
            alert::error('Jumlah yang anda transfer tidak sesuai jumlah yang harus dibayar','Terjadi Kesalahan!');
            return back();
        }
        else
        {
            $image = optional(Payment::find($request->payment_id))->images ?? null;

            if ($request->hasFile('file')) {
                $image = Storage::disk('uploads')->put('payment', $request->file('file'));
            }

            //simpan data payment
            $payment = Payment::updateOrCreate(
                [
                    'id' => $request->payment_id
                ],
                [
                'booking_id' => $request->booking_id,
                'bank_id' => $request->bank_to ,
                'bank_from' => $request->bank_from,
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
                'payment_transfer' => $request->transfer,
                'images' => $image
            ]);

        //    if($request->has('file'))
        //    {
               
        //     }
        //     else
        //     {
        //         //simpan data payment
        //         $payment = Payment::updateOrCreate(
        //             [
        //                 'id' => $request->payment_id
        //             ],
        //             [
        //             'booking_id' => $request->booking_id,
        //             'bank_id' => $request->bank_to ,
        //             'bank_from' => $request->bank_from,
        //             'account_number' => $request->account_number,
        //             'account_name' => $request->account_name,
        //             'payment_transfer' => $request->transfer
        //             ]);
        //     }
                

                //mendapatkan id booking
                $getBooking = Booking::where('id', $request->booking_id)->first();
                //ubah status booking
                $getBooking->update([
                    'status' => '1'
                ]);

                //mengirim email informasi booking
                // $getUser= auth()->user(); //mendapatkan id user
                // Mail::to($getUser->email)->send(new MailPaymentNotify($getUser,$getBooking, $payment));

                //mengirim notifikasi ke admin
                    $admin = User::where('level', 1)->get();
            
                    $details = [
                        'body' => auth()->user()->name . 'Telah Melakukan Pembayaran',
                    ];

                    Notification::send($admin, new PaymentNotification($details));

                Alert::success('Data Pembayaran Berhasil Ditambahkan Untuk Segera di Verifikasi', 'Sukses');
                return redirect()->route('dataBooking', Auth::user()->id);
        }
    }

    public function eTicket($booking_code)
    {
        //mendapatkan id Booking
        $booking = Booking::where('booking_code', $booking_code)->first();
        //mendapatkan data penumpang
        $passenger= Passenger::where('booking_id', $booking->id)->get();

        //mendapatkan barcode
        foreach($passenger as $passengers)
        $barcode="Jadwal ". Date::parse($booking->schedule->route->time_departure)->format('H:i'). " ". Date::parse($booking->schedule->date_departure)->format('l, j F Y')." ,Asal ". $booking->schedule->route->departure. " ,Tujuan  ".$booking->schedule->route->destination." ,Harga ".$booking->schedule->price. " ,Nama Penumpang ". $passengers->name. " ,No Identitas ".$passengers->identity." ,No Seat ".$passengers->seat;

        $pdf = PDF::loadview('homepage.eticket', compact('booking','passenger','barcode'))->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}
