@extends('template.homepage.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Data Calon Penumpang {{ config('app.name') }} </h4>
                  <p class="card-category">Relasi {{ $booking->schedule->route->departure}} - {{ $booking->schedule->route->destination }}. {{ Date::parse($booking->schedule->date_departure)->format('l, j F Y') }} Pukul {{ Date::parse($booking->schedule->route->time_departure)->format('H:i') }}</p>
                  <div class="float-right"><a class="btn btn-info" href="{{ route('dataBooking', Auth::user()->id)}}">Kembali</a></div>
                </div>
                <div class="card-body">
                  <form action="{{ route('updatePassenger',$booking->booking_code) }}" method="POST">
                   @csrf
                @foreach($passenger as $passengers)
                <input type="hidden" class="form-control" name="id[]" value="{{ $passengers->id}}">
    
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nama Penumpang </label>
                          <input type="text" class="form-control" name="name[]" id="name" value="{{ $passengers->name}}">
                          @if ($errors->has('name'))
                        <span class="badge badge-danger">
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                        </div>
                        
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nomor identitas penumpang</label>
                          <input type="text" class="form-control" name="identity[]" value="{{ $passengers->identity}}">
                          @if ($errors->has('identity'))
                        <span class="badge badge-danger">
                            {{ $errors->first('identity') }}
                        </span>
                        @endif
                        </div>
                      </div>
                    
                    </div>
                    @endforeach      
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                    <div class="clearfix"></div>
                    </div>
                  </form>
                </div>
              </div>
@endsection

@push('js')

<script>
   $(document).ready(function(){  
  $("select").change(function() {   
    $("select").not(this).find("option[value="+ $(this).val() + "]").attr('disabled', true);
  }); 
});
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')

@endpush