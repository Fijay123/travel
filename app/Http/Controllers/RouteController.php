<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Alert;
use App\Http\Requests\RouteRequest;

class RouteController extends Controller
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
        $route= Route::all();
        return view('admin.route.index', compact('route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.route.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteRequest $request)
    {
        //simpan data ke database
        $car= Route::create([
            'departure' => $request->departure,
            'destination' => $request->destination,
            'time_departure' => $request->time,
            'meeting_point' => $request->meeting_point
        ]);

        //menampilkan alert data berhasil disimpan
        Alert::success('Data Trayek Baru Berhasil Ditambahkan', 'Sukses');
        //redirect menuju index
        return redirect()->route('route.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Routes  $routes
     * @return \Illuminate\Http\Response
     */
    public function show(Routes $routes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Routes  $routes
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        return view('admin.route.edit', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Routes  $routes
     * @return \Illuminate\Http\Response
     */
    public function update(RouteRequest $request, Route $route)
    {
        $route->update([
            'departure' => $request->departure,
            'destination' => $request->destination,
            'time_departure' => $request->time,
            'meeting_point' => $request->meeting_point
        ]);

        //menampilkan alert data berhasil diubah
        Alert::success('Data Trayek Baru Berhasil Diubah', 'Sukses');
        //redirect menuju index
        return redirect()->route('route.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Routes  $routes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('route.index');
    }

    public function getStatus(Route $route)
    {
        return view('admin.route.getStatus', compact('route'));
    }

    public function changeStatus(Request $request, Route $route)
    {
        $route->update([
            'status' => $request->status
        ]);

        Alert::success('Data Status Trayek Berhasil Diubah','Sukses');
        return redirect()->route('route.index');
    }
}
