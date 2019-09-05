@extends('template.admin.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Edit Data</h4>
                  <p class="card-category">Edit Data Trayek {{ config('app.name') }}</p>
                </div>
                <div class="card-body">
                  <form action="{{ route('route.update', $route)}}" method="POST">
                   @csrf
                   @method('PUT')   
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Kota Asal</label>
                          <input type="text" class="form-control" name="departure" value="{{ $route->departure }}">
                          @if ($errors->has('departure'))
                        <span class="badge badge-danger">
                            {{ $errors->first('departure') }}
                        </span>
                        @endif
                        </div>
                        
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Kota Tujuan</label>
                          <input type="text" class="form-control" name="destination"  value="{{ $route->destination }}">
                          @if ($errors->has('destination'))
                        <span class="badge badge-danger">
                            {{ $errors->first('destination') }}
                        </span>
                        @endif
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Jam Keberangkatan</label>
                          <input type="text" class="form-control" id="time" name="time"  value="{{ $route->time_departure }}">
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                            @if ($errors->has('time'))
                        <span class="badge badge-danger">
                            {{ $errors->first('time') }}
                        </span>
                        @endif
                        </span>
                        </div>
                      </div>

                    <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Titik Kumpul</label>
                          <input type="text" class="form-control" name="meeting_point"  value="{{ $route->meeting_point }}">
                          @if ($errors->has('meeting_point'))
                        <span class="badge badge-danger">
                            {{ $errors->first('meeting_point') }}
                        </span>
                        @endif
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Ubah</button>
                    <div class="clearfix"></div>
                    </div>
                  </form>
                </div>
              </div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>

<script type="text/javascript">
    $('#time').clockpicker({
        donetext : 'set'
    });
</script>


@endpush