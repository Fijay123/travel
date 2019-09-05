@extends('template.homepage.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <p class="card-category">Cari Jadwal Keberangkatan {{ config('app.name') }}</p>
                </div>
                <div class="card-body">
                  <form action="{{ route('schedule')}}" method="GET">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tanggal Keberangkatan</label>
                          <input type="text" class="form-control" name="date" id="date">
                          @if ($errors->has('date'))
                        <span class="badge badge-danger">
                            {{ $errors->first('date') }}
                        </span>
                        @endif
                        </div>
                        
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Kota Asal</label>
                          <select name="departure" class="form-control">
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
                              @foreach($destination as $destinations)
                              <option value="{{ $destinations->destination}}">{{ $destinations->destination}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Jumlah Penupang</label>
                          <select name="passenger" class="form-control">
                              <option value="1">1 Orang</option>
                              <option value="2">2 Orang</option>
                              <option value="3">3 Orang</option>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#date" ).datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 1,
        maxDate: 7
    });
  });
  </script>
@endpush