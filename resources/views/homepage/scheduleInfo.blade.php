@extends('template.homepage.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Informasi Jadwal Keberangkatan {{ config('app.name') }}</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>Jam Keberangkatan</th>
                        <th>Kota Asal</th>
                        <th>Kota Tujuan</th>
                        <th>Harga Tiket</th>
                        <th>Armada</th>
                        <th>Titik Kumpul</th>
                        <th>Jumlah Penumpang</th>
                        <th>Total harga</th>
                      </thead>
                    <tr>
                        <td>{{ $schedule->route->time_departure}}</td>
                        <td>{{ $schedule->route->departure}}</td>
                        <td>{{ $schedule->route->destination }}</td>
                        <td>Rp. {{ number_format($schedule->price) }}</td>
                        <td>{{ $schedule->car->type}}</td>
                        <td>{{ $schedule->route->meeting_point }}</td>
                        <td>{{ session::get('passenger')}} Orang</td>
                        <td>Rp. {{number_format($schedule->price * session::get('passenger') )}}</td>
                    </tr>
                    </table>
                    <a class="btn btn-success pull-right" href="{{ route('bookingForm', $schedule)}}">Lanjutkan</a>
                  </div>
                </div>
              </div>
            </div>
           
@endsection