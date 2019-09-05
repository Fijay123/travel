@extends('template.homepage.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Data Calon Penumpang {{ config('app.name') }} </h4>
                  <p class="card-category">Relasi {{ $schedule->route->departure}} - {{ $schedule->route->destination }}. {{ Date::parse($schedule->date_departure)->format('l, j F Y') }} Pukul {{ Date::parse($schedule->route->time_departure)->format('H:i') }}</p>
                </div>
                <div class="card-body">
                  <form action="{{ route('bookingSave', $schedule)}}" method="POST">
                   @csrf
                   
                    
                  @for ($i=0; $i <=Session::get('passenger')-1; $i++)
                  
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nama Penumpang {{$i+1}}</label>
                          <input type="text" class="form-control" name="names[]" value="{{ old('name')}}">
                          @if ($errors->has('names.' . $i ))
                        <span class="badge badge-danger">
                            {{ $errors->first('names.'. $i) }}
                        </span>
                        @endif
                        </div>
                        
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nomor identitas penumpang {{ $i+1 }}</label>
                          <input type="text" class="form-control" name="identity[]">
                          @if ($errors->has('identity.' . $i))
                        <span class="badge badge-danger">
                            {{ $errors->first('identity.' . $i) }}
                        </span>
                        @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nomor Kursi penumpang {{ $i+1 }}</label>
                          <select name="seat[]" class="form-control" id="seat">
                          <option selected value="0">-- pilih nomor kursi --</option>
                          @foreach($seat as $seats)
                          <option value="{{ $seats->id }}">{{ $seats->number }}</option>
                            @endforeach
                          </select>
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                            @if ($errors->has('seat.' . $i))
                        <span class="badge badge-danger">
                            {{ $errors->first('seat.' . $i) }}
                        </span>
                        @endif
                        </span>
                        </div>
                      </div>

                    
                    </div>
                    @endfor
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
@endpush