@extends('template.admin.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Ubah Status Trayek</h4>
                  <p class="card-category">Ubah Status Trayek {{ config('app.name') }}</p>
                </div>
                <div class="card-body">
                  <form action="{{ route('route.changeStatus', $route)}}" method="POST">
                   @csrf   
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pilih Status Tayek</label>
                        <select name="status" class="form-control">
                        <option value="0" @if($route->status == "0") selected @endif>Non Aktif</option>
                        <option value="1" @if($route->status == "1") selected @endif>Aktif</option>
                        </select>                         
                        </div>
                      
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                    <div class="clearfix"></div>
                    </div>
                  </form>
                </div>
              </div>
@endsection

