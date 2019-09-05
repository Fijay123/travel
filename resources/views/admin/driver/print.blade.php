<table width="100%" border="0">
    <tr>
        <td width="25%"><img src="data:image/png;base64,{{ DNS2D::getBarcodePNG("Nama  ".$driver->name." ,Alamat ".$driver->address.", Telp ".$driver->telp, 'QRCODE')}}" alt="barcode" width="150px" height="150px" /></td>
        <td><center><h1>Kartu Tanda Driver <br> {{ config('app.name')}}</h1></center></td>
        <td width="25%"><img src="{{ asset ($driver->images)}}" width="150px" height="150px"></td>
    </tr>
</table>
<hr>
<table width="100%" border="0">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $driver->name }}</td>
    </tr>
    <tr>
        <td>No. SIM</td>
        <td>:</td>
        <td>{{ $driver->driver_license }}</td>
    </tr>

    <tr>
        <td>Nomor HP</td>
        <td>:</td>
        <td>{{ $driver->telp }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $driver->address }}</td>
    </tr>
    <tr>
        <td>Tanggal Bergabung</td>
        <td>:</td>
        <td>{{ Date::parse($driver->created_at)->format('j F Y') }}</td>
    </tr>
</table>