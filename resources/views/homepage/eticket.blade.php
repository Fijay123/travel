<html>
    <head>
        <title>E-Ticket {{ config('app.name')}}</title>
    </head>
    <body>
    @foreach($passenger as $passengers)
        <table width="100%" border="0">
            <tr>
                <td width="70%"><center>E-Ticket {{ config('app.name')}}</center></td>
                <td rowspan="4"><img src="data:image/png;base64,{{DNS2D::getBarcodePNG("Jadwal ". Date::parse($booking->schedule->route->time_departure)->format('H:i'). " ". Date::parse($booking->schedule->date_departure)->format('l, j F Y')." ,Asal ". $booking->schedule->route->departure. " ,Tujuan  ".$booking->schedule->route->destination." ,Harga ".$booking->schedule->price. " ,Nama Penumpang ". $passengers->name. " ,No Identitas ".$passengers->identity." ,No Seat ".$passengers->seat, 'QRCODE')}}" alt="barcode" /></td>
            </tr>
            <tr>
                <td><center>Melayani Antar Kota Banyuwangi</center></td>
            </tr>
            <tr>
                <td><center>Jl. Ayam Geprek Rogojampi </center></td>
            </tr>
            <tr>
                <td><center>Banyuwangi</center></td>
            </tr>
        </table>
        <hr>
        <br>
        <table width="100%">
            <tr>
                <td width="50%">
                    <table>
                        <tr>
                            <td>Nama Penumpang</td>
                            <td>:</td>
                            <td>{{ $passengers->name }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Identitas</td>
                            <td>:</td>
                            <td>{{ $passengers->identity }}</td>
                        </tr>
                        <tr>
                            <td>Jadwal Keberangkatan</td>
                            <td>:</td>
                            <td>{{ Date::parse($booking->schedule->date_departure)->format('l, j F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Asal</td>
                            <td>:</td>
                            <td>{{ $booking->schedule->route->departure }}</td>
                        </tr>
                        <tr>
                            <td>Tujuan</td>
                            <td>:</td>
                            <td>{{ $booking->schedule->route->destination }}</td>
                        </tr>
                                         
                    </table>
                </td>
                <td width="50%">
                <table>
                        <tr>
                            <td>Tarif</td>
                            <td>:</td>
                            <td>{{ $booking->schedule->price }}</td>
                        </tr>     
                        <tr>
                            <td>Jam Keberangkatan</td>
                            <td>:</td>
                            <td>{{Date::parse($booking->schedule->route->time_departure)->format('H:i') }} WIB</td>
                        </tr>
                        <tr>
                            <td>Armada</td>
                            <td>:</td>
                            <td>{{ $booking->schedule->car->type }} ({{ $booking->schedule->car->police_number }})</td>
                        </tr>
                        <tr>
                            <td>Seat</td>
                            <td>:</td>
                            <td>{{ $passengers->seat }}</td>
                        </tr>
                                             
                    </table>
                </td>
            </tr>
        </table>
        <hr>
        <br>
        @endforeach
       
    </body>
</html>