@extends('template.admin.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">
                @if($departure == '0' && $destination == '0')
                  Data Laporan Pendapatan {{ config('app.name')}} Periode {{ Date::parse($start_date)->format('j F') }} sampai {{ Date::parse($end_date)->format('j F Y') }}
                @endif
                  </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                      <th>No</th>
                        <th>Jumlah</th>
                      </thead>
                      <tbody>
                      @php $no=0; @endphp
                        @foreach($payment as $payments)
                            @php $no++; @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ number_format($payments->payment_transfer) }}</td>
                            <td>{{ $payment->sum('payment_transfer') }}</td>
                                                 
                        </tr>
                    @endforeach        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
           
@endsection