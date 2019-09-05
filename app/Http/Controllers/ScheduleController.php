<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\{Driver, Car, Route, Seat};
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
use Alert;
use Date;

class ScheduleController extends Controller
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
        $schedule = Schedule::orderBy('id', 'Desc')->get();
        $seat = new Seat;
        return view('admin.schedule.index', compact('schedule', 'seat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $driver = Driver::where('status', 1)->get();
        $car = Car::where('status', 1)->get();
        $route = Route::where('status', 1)->get();
        return view('admin.schedule.add', compact('driver','car','route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        $getCar = Car::where('id', $request->car)->first();              //mendapatkan data armada dan jumlah seat
         //cek kendaraan pada hari yang sama
        $checkCar = Schedule::where('date_departure', $request->date)
                    ->where('car_id', $request->car)
                    ->first();
                                                         //cek driver pada hari yang sama
        $checkDriver= Schedule::where('date_departure', $request->date)
                        ->where('driver_id', $request->driver)
                        ->first();

        if($checkCar == !null && $checkDriver == !null)
        {
            Alert::error('Kendaraan dan Sopir pada tanggal ini sudah digunakan', 'Error');
            return back();
        }
        elseif ($checkCar == !null)
        {
            Alert::error('Kendaraan pada tanggal ini sudah digunakan', 'Error');
            return back();
        }

        elseif ($checkDriver == !null)
        {
            Alert::error('Driver pada tanggal ini sudah digunakan', 'Error');
            return back();
        }
        else
        {

            $schedule = Schedule::create([
                'car_id' => $request->car,
                'route_id' => $request->route,
                'driver_id' => $request->driver,
                'date_departure' => $request->date,
                'seat' => $getCar->seat,
                'price' => $request->price
                ]);

                                     //menambahkan ke tabel seat
                    for($number=1; $number <= $getCar->seat; $number++ )
                    {    
                        $seat = Seat::create([
                            'schedule_id' => $schedule->id,
                            'number' => $number
                        ]);
                    }
    
                Alert::success('Data Jadwal Keberangkatan Ditambahkan', 'Sukses');
                return redirect()->route('schedule.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $driver = Driver::where('status', 1)->get();
        $car = Car::where('status', 1)->get();
        $route = Route::where('status', 1)->get();
        return view('admin.schedule.edit', compact('schedule','driver','car','route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * 
     
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $getCar = Car::where('id', $request->car)->first();                                         //mendapatkan data armada dan jumlah seat

            if($request->car != $schedule->car_id && $request->driver == $schedule->driver_id)
            {
                $checkCar = Schedule::where('date_departure', $request->date)
                            ->where('car_id', $request->car)
                            ->first();

                if($checkCar)
                {
                    Alert::error('Kendaraan pada tanggal ini sudah digunakan', 'Error');
                    return back();
                }
            }

            if($request->car == $schedule->car_id && $request->driver != $schedule->driver_id)
            {
                $checkdriver = Schedule::where('date_departure', $request->date)
                            ->where('driver_id', $request->driver)
                            ->first();

                if($checkdriver)
                {
                    Alert::error('Sopir pada tanggal ini sudah digunakan', 'Error');
                    return back();
                }
            }

                        //menghapus seat sebelumnya jika armada diubah
            if($schedule->car_id != $request->car)
            {
                $delete=Seat::where('schedule_id',$schedule->id)->delete();

                                //menambahkan seat baru
                for($number=1; $number <= $getCar->seat; $number++ )
                {    
                    $seat = Seat::create([
                        'schedule_id' => $schedule->id,
                        'number' => $number
                    ]);
                }
            }

                                                                                 //mengubah data schedule
                $schedule->update([
                    'car_id' => $request->car,
                    'route_id' => $request->route,
                    'driver_id' => $request->driver,
                    'date_departure' => $request->date,
                    'seat' => $getCar->seat,
                    'price' => $request->price
                ]);

            

            Alert::success('Data Jadwal Keberangkatan Berhasil Diubah', 'Sukses');
            return redirect()->route('schedule.index');
            
        }
       
        
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedule.index');
    }

    public function getStatus(schedule $schedule)
    {
        return view('admin.schedule.getStatus', compact('schedule'));
    }

    public function changeStatus(Request $request, schedule $schedule)
    {
        $schedule->update([
            'status' => $request->status
        ]);

        Alert::success('Data Status Trayek Berhasil Diubah','Sukses');
        return redirect()->route('schedule.index');
    }
}
