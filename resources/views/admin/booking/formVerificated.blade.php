@extends('template.admin.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Form Verifikasi kode booking <b>{{ $booking->booking_code}}</b> {{ config('app.name') }}</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>Nama Pemesan</th>
                        <th>Jadwal Keberangkatan</th>
                        <th>Kota Asal </th>
                        <th>Kota Tujuan</th>
                        <th>Jam Keberangkatan</th>
                        <th>Penumpang</th>
                        <th>Total Harga</th>
                        <th>Jumlah Transfer</th>
                        <th>Dari Bank</th>
                        <th>Nama</th>
                        <th>No. Rekening</th>
                        <th>Bank Tujuan</th>
                        <th>Bukti Transfer</th>
                        <th>action</th>
                      </thead>
                      <tbody>
                      <form action="{{ route('verificatedSave', $booking->booking_code)}}" method="POST">
                        @csrf  
                         <tr>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ Date::parse($booking->schedule->date_departure)->format('l, j F Y')}}</td>
                            <td>{{ $booking->schedule->route->departure }}</td>
                            <td>{{ $booking->schedule->route->destination }}</td>
                            <td>{{ Date::parse($booking->schedule->route->time_departure)->format('H:i')}}</td>
                            <td>{{ $booking->qty }} Orang</td>
                            <td>Rp. {{ number_format($booking->total) }}</td>
                            <td>Rp. {{ number_format($payment->payment_transfer) }}</td>
                            <td>{{ $payment->bank_from}}</td>
                            <td>{{ $payment->account_name}}</td>
                            <td>{{ $payment->account_number}}</td>
                            <td>{{ $payment->bank->bank_name}}</td>
                            <td> <img id="myImg" src="{{asset($payment->images)}}" style="width:100%;max-width:300px"></td>
                            <td>
                                <select name="verificated">
                                <option selected value ="0">-- pilih status --</option>
                                <option value="2"> verified </option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success btn-sm">Simpan </button>
                            </td>
                        </tr>
                        </form>      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
           
           <!-- Modal untuk menampilkan bukti transfer -->
            <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="images">
            <div id="caption"></div>
            </div>
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("images");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
@endpush

@push('css')
<style>
body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: relative; 
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
@endpush