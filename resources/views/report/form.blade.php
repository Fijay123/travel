@extends('template.admin.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <p class="card-category">Laporan Pendapatan {{ config('app.name') }}</p>
                </div>
                <div class="card-body">
                  <form action="{{ route('reportResult')}}" method="GET">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tanggal Awal</label>
                          <input type="text" class="form-control" name="start_date" id="start_date">
                          @if ($errors->has('start_date'))
                        <span class="badge badge-danger">
                            {{ $errors->first('start_date') }}
                        </span>
                        @endif
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tanggal Akhir</label>
                          <input type="text" class="form-control" name="end_date" id="end_date">
                          @if ($errors->has('end_date'))
                        <span class="badge badge-danger">
                            {{ $errors->first('end_date') }}
                        </span>
                        @endif
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Kota Asal</label>
                          <select name="departure" class="form-control">
                                <option selected value="0"> -- Pilih Kota Asal --</option>
                              @foreach($departure as $departures)
                              <option value="{{ $departures->departure }}">{{ $departures->departure }}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Kota Tujuan</label>
                          <select name="destination" class="form-control">
                                <option selected value="0"> -- Pilih Kota Tujuan --</option>
                              @foreach($destination as $destinations)
                              <option value="{{ $destinations->destination }}">{{ $destinations->destination }}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                     
                      
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Cari</button>
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
    $( "#start_date" ).datepicker({
        dateFormat: 'yy-mm-dd'
    });

     $( "#end_date" ).datepicker({
        dateFormat: 'yy-mm-dd'
    });
  });
  </script>
@endpush