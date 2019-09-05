@extends('template.homepage.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Form Konfirmasi Pembayaran {{ config('app.name') }} </h4>
                  <p class="card-category">Relasi {{ $booking->schedule->route->departure}} - {{ $booking->schedule->route->destination }}. {{ Date::parse($booking->schedule->date_departure)->format('l, j F Y') }} Pukul {{ Date::parse($booking->schedule->route->time_departure)->format('H:i') }}</p>
                </div>
                <div class="card-body">
                  <form action="{{ route('saveConfirmation', $booking->booking_code)}}" method="POST" enctype="multipart/form-data">
                   @csrf
                   <input type="hidden" value="{{ $booking->id }}" name="booking_id">
                   <input type="hidden" value="{{ $payment->id ?? '' }}" name="payment_id">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nama Pemesan</label>
                          <input type="text" class="form-control" value="{{ $booking->user->name }}" disabled>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Jumlah Yang Harus Dibayar</label>
                          <input type="text" class="form-control" value="Rp. {{ number_format($booking->total) }}" disabled>
                          <input type="hidden" value="{{ $booking->total }}" name="price">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Bank Pengirim </label>
                          <input type="text" class="form-control" name="bank_from" value="{{  $payment->bank_from ?? '' }}">
                          @if ($errors->has('bank_from'))
                        <span class="badge badge-danger">
                            {{ $errors->first('bank_from') }}
                        </span>
                        @endif
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nama Pemilik Rekening</label>
                          <input type="text" class="form-control" name="account_name" value="{{  $payment->account_name ?? '' }}">
                          @if ($errors->has('account_name'))
                        <span class="badge badge-danger">
                            {{ $errors->first('account_name') }}
                        </span>
                        @endif
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nomor Rekening Pengirim</label>
                          <input type="text" class="form-control" name="account_number" value="{{  $payment->account_number ?? '' }}">
                          @if ($errors->has('account_number'))
                        <span class="badge badge-danger">
                            {{ $errors->first('account_number') }}
                        </span>
                        @endif
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Bank Tujuan Pengiriman</label>
                          <select name="bank_to" class="form-control">
                            <option selected value="0">-- Plih Bank tujuan pengiriman --</value>
                            @foreach($bank as $banks)
                              @if($payment == null)
                                <option value="{{ $banks->id}}">{{ $banks->bank_name }}</option>
                              @else
                              <option value="{{ $banks->id}}" @if($payment->bank_id  === $banks->id) selected  @endif>{{ $banks->bank_name }}</option>
                              @endif
                            @endforeach
                          </select>
                          @if ($errors->has('bank_to'))
                        <span class="badge badge-danger">
                            {{ $errors->first('bank_to') }}
                        </span>
                        @endif
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Jumlah Transfer</label>
                          <input type="text" class="form-control" name="transfer" id="transfer" onkeyup="document.getElementById('showValue').innerHTML = formatCurrency(this.value);" value="{{  $payment->payment_transfer ?? '' }}"><p id="showValue"></p>
                          @if ($errors->has('transfer'))
                        <span class="badge badge-danger">
                            {{ $errors->first('transfer') }}
                        </span>
                        @endif
                        </div>
                      </div>

                     <div class="col-md-4">
                        <div class="fileinput">
                            <label class="bmd-label-floating">Bukti Transfer</label>
                        <div>
                         <span class="btn-file">
                            <input type="file" name="file" class="form-control"/>
                        </span></div>
                        @if ($errors->has('file'))
                        <span class="badge badge-danger">
                            {{ $errors->first('file') }}
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

@push('js')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')


<script>
    
    function formatCurrency(transfer) {
        
        transfer = transfer.toString().replace(/\$|\,/g,'');
        if(isNaN(transfer))
            transfer = "0";
            sign = (transfer == (transfer = Math.abs(transfer)));
            transfer = Math.floor(transfer*100+0.50000000001);
            cents = transfer%100;
            transfer = Math.floor(transfer/100).toString();

        if(cents<10)
            cents = "0" + cents;
            for (var i = 0; i < Math.floor((transfer.length-(1+i))/3); i++)
                transfer = transfer.substring(0,transfer.length-(4*i+3))+'.'+
                transfer.substring(transfer.length-(4*i+3));

        return (((sign)?'':'-') + 'Rp ' + transfer);
    } 
    
</script>
@endpush