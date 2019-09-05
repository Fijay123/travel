@extends('template.admin.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Tambah Data</h4>
                  <p class="card-category">Tambah Data Sopir {{ config('app.name') }}</p>
                </div>
                <div class="card-body">
                @if(isset($driver))
                <form action="{{ route('driver.update', $driver)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @else
                  <form action="{{ route('driver.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf 
                @endif
                <input type="hidden" name="driver_id" value="{{ $driver->id ?? ''}}">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nama</label>
                          <input type="text" class="form-control" name="name" value="{{ $driver->name ?? ''}}">
                          @if ($errors->has('name'))
                        <span class="badge badge-danger">
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                        </div>
                      </div>
                      

                       <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nomor SIM</label>
                          <input type="text" class="form-control" name="license" value="{{ $driver->driver_license ?? ''}}">
                          @if ($errors->has('license'))
                        <span class="badge badge-danger">
                            {{ $errors->first('license') }}
                        </span>
                        @endif
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Telp</label>
                          <input type="text" class="form-control" name="phone" value="{{ $driver->telp ?? ''}}">
                          @if ($errors->has('phone'))
                        <span class="badge badge-danger">
                            {{ $errors->first('phone') }}
                        </span>
                        @endif
                        </div>
                      </div>

                       <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Alamat</label>
                          <input type="text" class="form-control" name="address" value="{{ $driver->address ?? ''}}">
                          @if ($errors->has('address'))
                        <span class="badge badge-danger">
                            {{ $errors->first('address') }}
                        </span>
                        @endif
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="fileinput">
                            <label class="bmd-label-floating">Foto</label>
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

