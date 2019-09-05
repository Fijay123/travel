<!DOCTYPE html>
<html>
<head>
 <title>informasi booking {{ config('app.name')}}</title>
</head>
<body>

 <p>Dear, {{ $user->name }}</p>
 <h1>Kode Booking Kamu {{ $booking->booking_code }}</h1>

<table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Tanggal Berangkat</th>
                    <th>Kota Asal</th>
                    <th>Kota Tujuan</th>
                    <th>Jumlah Penumpang</th>
                    <th>Total Harga</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ Date::parse($schedule->date_departure)->format('l, j F Y') }}</td>
                    <td>{{ $schedule->route->departure}}</td>
                    <td>{{ $schedule->route->destination }}</td>
                    <td>{{ $booking->qty }}</td>
                    <td>{{ $booking->qty * $schedule->price}}</td>                    
                  </tr>
              
                </tbody>
              </table>
    <p>Silahkan Melakukan Pembayaran pada <b> {{ Date::parse($booking->created_at)->format('l, j F Y') }} sebelum pukul {{ Date::parse($booking->available_until)->format('H:i') }} </b>
</body>
</html> 