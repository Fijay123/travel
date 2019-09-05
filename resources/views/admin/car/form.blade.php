@extends('template.admin.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Tambah Data</h4>
                  <p class="card-category">Tambah Data Armada {{ config('app.name') }}</p>
                </div>
                <div class="card-body">
                @if(isset($car))
                <form action="{{ route('car.update', $car)}}" method="POST">
                @csrf
                @method('PUT')
                @else
                  <form action="{{ route('car.store')}}" method="POST">
                  @csrf 
                @endif
                    
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nomor Polisi</label>
                          <input type="text" class="form-control" name="police_number" value="{{ $car->police_number ?? ''}}">
                          @if ($errors->has('police_number'))
                        <span class="badge badge-danger">
                            {{ $errors->first('police_number') }}
                        </span>
                        @endif
                        </div>
                      </div>
                      

                       <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Type</label>
                          <input type="text" class="form-control" name="type" value="{{ $car->type ?? ''}}">
                          @if ($errors->has('type'))
                        <span class="badge badge-danger">
                            {{ $errors->first('type') }}
                        </span>
                        @endif
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Jumlah Kursi</label>
                          <input type="text" class="form-control" name="seat" value="{{ $car->seat ?? ''}}">
                          @if ($errors->has('seat'))
                        <span class="badge badge-danger">
                            {{ $errors->first('seat') }}
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

