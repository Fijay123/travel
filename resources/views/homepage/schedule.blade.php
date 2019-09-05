@extends('template.homepage.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Jadwal Keberangkatan {{ Date::parse($date)->format('l, j F Y')}} {{ config('app.name') }}</h4>
                  <h7>Jumlah Penumpang {{ $passenger }} Orang</h7>
                  <div class="float-right"><a class="btn btn-info" href="{{ route('index')}}">Ubah Pencarian</a></div></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                      <th>No</th>
                        <th>Jam Keberangkatan</th>
                        <th>Kota Asal</th>
                        <th>Kota Tujuan</th>
                        <th>Harga Tiket</th>
                        <th>Sisa Kursi</th>
                        <th>Armada</th>
                        <th>Titik Kumpul</th>
                      </thead>
                      <tbody>
                      @php $no=0; @endphp
                        @foreach($schedule as $schedules)
                            @php $no++; @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ Date::parse($schedules->route->time_departure)->format('H:i') }}</td>
                            <td>{{ $schedules->route->departure}}</td>
                            <td>{{ $schedules->route->destination}}</td>
                            <td>{{ number_format($schedules->price) }}</td>
                            <td>{{ $seat->seat($schedules->id)->count() }}</td>
                            <td>{{ $schedules->car->type }}</td>
                            <td>{{ $schedules->route->meeting_point }}</td>
                            <td>
                              @if($passenger <= $seat->seat($schedules->id)->count() )
                                <form action="{{ route('scheduleInfo', $schedules)}}" method="post">
                                @csrf
                                  <input type="hidden" value="{{ $passenger }}" name="passenger">
                                    <button class="btn btn-info btn-sm" type="submit">Pesan</button>
                                </form>
                              @else
                              <button class="btn btn-default btn-sm" disabled="disabled">Pesan</button>
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