@extends('template.admin.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Tambah Data</h4>
                  <p class="card-category">Tambah Data Jadwal Keberangkatan {{ config('app.name') }}</p>
                </div>
                <div class="card-body">
                  <form action="{{ route('schedule.store')}}" method="POST">
                   @csrf   
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tanggal Keberangkatan</label>
                          <input type="text" class="form-control" name="date" id="date" value="{{ old('date') }}">
                          @if ($errors->has('date'))
                        <span class="badge badge-danger">
                            {{ $errors->first('date') }}
                        </span>
                        @endif
                        </div>
                        
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Trayek</label>
                          <select name="route" class="form-control">
                              <option selected value="0">-- Pilih Trayek --</option>
                              @foreach($route as $routes)
                              <option value="{{ $routes->id}}">{{ $routes->departure}}-{{ $routes->destination}}({{ Date::parse($routes->time_departure)->format('H:i')}})</option>
                              @endforeach
                            </select>
                          @if ($errors->has('route'))
                        <span class="badge badge-danger">
                            {{ $errors->first('route') }}
                        </span>
                        @endif
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Armada</label>
                          <select name="car" class="form-control">
                              <option selected value="0">-- Pilih Armada --</option>
                              @foreach($car as $cars)
                              <option value="{{ $cars->id}}">{{ $cars->type}} ({{ $cars->police_number}})</option>
                              @endforeach
                            </select>
                          @if ($errors->has('car'))
                        <span class="badge badge-danger">
                            {{ $errors->first('car') }}
                        </span>
                        @endif
                        </div>
                      </div>

                    <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Driver</label>
                          <select name="driver" class="form-control">
                              <option selected value="0">-- Pilih Driver --</option>
                              @foreach($driver as $drivers)
                              <option value="{{ $drivers->id}}">{{ $drivers->name}}</option>
                              @endforeach
                            </select>
                          @if ($errors->has('driver'))
                        <span class="badge badge-danger">
                            {{ $errors->first('driver') }}
                        </span>
                        @endif
                        </div>
                      </div>

                       <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Harga Tiket</label>
                          <input type="text" class="form-control" name="price" id="price" onkeyup="document.getElementById('showValue').innerHTML = formatCurrency(this.value);" value="{{ old('price') }}"><p id="showValue"></p>
                          @if ($errors->has('price'))
                        <span class="badge badge-danger">
                            {{ $errors->first('price') }}
                        </span>
                        @endif
                        </div>
                      </div>
                      
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                    <div class="clearfix"></div>
                    </div>
                  </form>
                </div>
              </div>
@endsection

@push('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

@push('js')
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#date" ).datepicker({
        dateFormat: 'yy-mm-dd',
        minDate :  1
    });
  });
  </script>

  <script>
    
    function formatCurrency(price) {
        
        price = price.toString().replace(/\$|\,/g,'');
        if(isNaN(price))
            price = "0";
            sign = (price == (price = Math.abs(price)));
            price = Math.floor(price*100+0.50000000001);
            cents = price%100;
            price = Math.floor(price/100).toString();

        if(cents<10)
            cents = "0" + cents;
            for (var i = 0; i < Math.floor((price.length-(1+i))/3); i++)
                price = price.substring(0,price.length-(4*i+3))+'.'+
                price.substring(price.length-(4*i+3));

        return (((sign)?'':'-') + 'Rp ' + price);
    } 
    
  </script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')
@endpush