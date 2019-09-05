@extends('template.homepage.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Booking a.n {{ Auth::user()->name}} di {{ config('app.name') }}</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                      <th>No</th>
                        <th>Tanggal Berangkat</th>
                        <th>Relasi</th>
                        <th>Jam Berangkat</th>
                        <th>Kode Booking</th>
                        <th>Jumlah Penumpang</th>
                        <th>Total Bayar</th>
                        <th>Batas Pembayaran</th>
                        <th>Status</th>
                      </thead>
                      <tbody>
                      @php $no=0; @endphp
                        @foreach($booking as $bookings)
                            @php $no++; @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ Date::parse($bookings->schedule->date_departure)->format('l, j F Y') }}</td>
                            <td>{{ $bookings->schedule->route->departure}} - {{ $bookings->schedule->route->destination}}</td>
                            <td>{{ Date::parse($bookings->schedule->route->time_departure)->format('H:i') }}</td>
                            <td>{{ $bookings->booking_code }}</td>
                            <td><a href="{{ route('dataPassenger', $bookings->booking_code)}}">{{ $bookings->qty}}</a></td>
                            <td>Rp. {{ number_format($bookings->total) }}</td>
                            <td>
                                @if($bookings->available_until < $now && $bookings->status ===1 )
                              <span class="badge badge-info">Etiket sedang disipkan</span>
                              @elseif($bookings->available_until < $now && $bookings->status ===2 )
                              <span class="badge badge-success">Silahkan cetak etiket</span>
                                @elseif($bookings->available_until < $now)
                                <span class="badge badge-danger">Waktu Pembayaran Habis</span>
                                @else
                                <span class="badge badge-warning">{{ Date::parse($bookings->available_until)->format('H:i') }}</span>
                                @endif
                            </td>
                            <td> @if($bookings->status === 0)
                              <span class="badge badge-danger">Belum Dibayar</span>
                              @elseif($bookings->status === 1)
                              <span class="badge badge-warning">Sedang di verifikasi</span>
                              @elseif($bookings->status === 3)
                              <span class="badge badge-danger">Sudah Selesai</span>
                              @elseif($bookings->status === 4)
                              <span class="badge badge-danger">Kadaluarsa</span>
                                @else
                              <span class="badge badge-success">Sudah Dibayar</span>
                              @endif</td>
                              <td>
                             
                              @if( $now < $bookings->available_until && $bookings->status === 0)
                              <a href="{{ route('formConfirmation', $bookings->booking_code)}}" class="btn btn-default btn-sm">Konfirmasi Pembayaran</a>
                              @elseif($now < $bookings->available_until && $bookings->status === 1 )
                              <a href="{{ route('formConfirmation', $bookings->booking_code)}}" class="btn btn-default btn-sm">Konfirmasi Pembayaran</a>
                              @elseif($now > $bookings->available_until && $bookings->status === 0)
                              <span class="badge badge-danger">Silahkan Melakukan Pemesanan Ulang</span>
                              @elseif($bookings->status === 2)
                              <a href="{{ route('eTicket', $bookings->booking_code)}}" class="btn btn-success btn-sm">cetak E-Ticket</a>
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