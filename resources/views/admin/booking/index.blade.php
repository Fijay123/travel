@extends('template.admin.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Booking {{ config('app.name') }}</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>No.</th>
                        <th>Jadwal Keberangkatan</th>
                        <th>Kota Asal </th>
                        <th>Kota Tujuan</th>
                        <th>Jam Keberangkatan</th>
                        <th>Kode Booking</th>
                        <th>Jumlah Penumpang</th>
                        <th>Status</th>
                        <th>action</th>
                      </thead>
                      <tbody>
                          @php $no=0; @endphp
                    @foreach($booking as $bookings)
                        @php $no++ @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ Date::parse($bookings->schedule->date_departure)->format('l, j F Y')}}</td>
                          <td>{{ $bookings->schedule->route->departure}}</td>
                          <td>{{ $bookings->schedule->route->destination}}</td>
                          <td>{{ Date::parse($bookings->schedule->route->time_departure)->format('H:i')}}</td>
                          <td>{{$bookings->booking_code}}</td>
                          <td>{{$bookings->qty}}</td>
                          <td> 
                              @if($bookings->status === 0)
                              <span class="badge badge-danger">Belum Dibayar</span>
                              @elseif($bookings->status === 1)
                              <span class="badge badge-warning">Menunggu Verifikasi</span>
                              @elseif($bookings->status === 2)
                              <span class="badge badge-success">Sudah Dibayar</span>
                              @endif
                                
                        </td>
                        <td>@if($bookings->status === 1)
                            <a href="{{ route('verificatedForm', $bookings->booking_code)}}" class="btn btn-warning btn-sm">Verifikasi</a>
                            @elseif($bookings->status === 2)
                            <span class="badge badge-success">Bisa Cetak Tiket</span>
                            @else
                            <span class="badge badge-warning">Belum ada aksi</span>
                            @endif
                        </td>
                        </tr>
                    @endforeach        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
           
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')
@endpush