<!DOCTYPE html>
<html>
<head>
 <title>informasi pembayaran {{ config('app.name')}}</title>
</head>
<body>

 <p>Dear, {{ $user->name }}</p>
 <h1>Kamu telah melakukan Transfer sebesar Rp. {{ number_format($payment->payment_transfer)}} untuk pembayaran dengan Kode Booking {{ $booking->booking_code }}, Tunggu sebentar Tim Kami Akan Melakukan Verifikasi</h1>

<table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Bank Untuk Transfer</th>
                    <th>No Rekening</th>
                    <th>Nama Pemilik Rekening</th>
                    <th>Bank Tujuan Transfer</th>
                    <th>Jumlah Transfer</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $payment->bank_from }}</td>
                    <td>{{ $payment->account_number}}</td>
                    <td>{{ $payment->account_name }}</td>
                    <td>{{ $payment->bank->bank_name }}</td>
                    <td>{{ number_format($payment->payment_transfer) }}</td>                    
                  </tr>
              
                </tbody>
              </table>
    
</body>
</html> 