<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Alert, Storage, PDF;
use App\Http\Requests\DriverRequest;

class DriverController extends Controller
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
        $driver = driver::all();
        return view ('admin.driver.index', compact('driver'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.driver.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverRequest $request)
    {
        $image = Storage::disk('uploads')->put('driver', $request->file('file'));
        Driver::create([
            'name' => $request->name,
            'driver_license' => $request->license,
            'telp' => $request->phone,
            'address' => $request->address,
            'images' => $image
        ]);

        Alert::success('Data Driver Berhasil Ditambahkan', 'sukses!');
        return redirect()->route('driver.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        return view('admin.driver.form', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(DriverRequest $request, Driver $driver)
    {
       
            $image = Storage::disk('uploads')->put('driver', $request->file('file')) ?? null;
            //$image = optional(Driver::find($request->driver_id))->images ?? null;
            $driver->update([
                'name' => $request->name,
                'driver_license' => $request->license,
                'telp' => $request->phone,
                'address' => $request->address,
                'images' => $image
            ]);
        

        Alert::success('Data Driver Berhasil Diubah','Sukses');
        return redirect()->route('driver.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('driver.index');
    }

    public function getStatus($driver)
    {
        $getDriver = Driver::where('id', $driver)->first();
        return view('admin.driver.getStatus', compact('getDriver'));
    }

    public function changeStatus(Request $request, driver $driver)
    {
       $driver->update([
           'status' => $request->status,
       ]);

       Alert::success('Status Driver Berhasil Diperbarui','Sukses !');
       return redirect()->route('driver.index');
    }

    public function print(Driver $driver)
    {
        $pdf = PDF::loadview('admin.driver.print', compact('driver'))->setPaper('A4', 'potrait');
        return $pdf->stream();
        //return view('admin.driver.print', compact('driver'));
    }
}
