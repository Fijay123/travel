<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Alert;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified','userLevelMiddleware']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car = Car::all();
        return view ('admin.car.index', compact('car'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'police_number' => 'required',
            'type' => 'required',
            'seat' => 'required|numeric'
        ],
        [
            'police_number.required' => 'Nomor Polisi Harus Di isi',
            'type.required' => 'Type Armada Harus Di isi',
            'seat.required' => 'Jumlah Seat Harus Di isi',
            'seat.numeric' => 'Jumlah seat tidak valid',
        ]);

        Car::create([
            'police_number' => $request->police_number,
            'type' => $request->type,
            'seat' => $request->seat,
        ]);

        Alert::success('Data Armada Berhasil Ditambahkan', 'sukses !');
        return redirect()->route('car.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view('admin.car.form', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'police_number' => 'required',
            'type' => 'required',
            'seat' => 'required|numeric'
        ],
        [
            'police_number.required' => 'Nomor Polisi Harus Di isi',
            'type.required' => 'Type Armada Harus Di isi',
            'seat.required' => 'Jumlah Seat Harus Di isi',
            'seat.numeric' => 'Jumlah seat tidak valid',
        ]);

        $car->update([
            'police_number' => $request->police_number,
            'type' => $request->type ,
            'seat' => $request->seat,
            'status' => 0,
        ]);

        Alert::success('Data Armada Berhasil Diubah','Sukses');
        return redirect()->route('car.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('car.index');
    }

    public function getStatus($car)
    {
        $getCar = Car::where('id', $car)->first();
        return view('admin.car.getStatus', compact('getCar'));
    }

    public function changeStatus(Request $request, Car $car)
    {
       $car->update([
           'status' => $request->status,
       ]);

       Alert::success('Status Armada Berhasil Diperbarui','Sukses !');
       return redirect()->route('car.index');
    }
}
