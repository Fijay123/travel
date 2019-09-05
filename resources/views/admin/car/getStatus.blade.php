@extends('template.admin.template')
@section('content')

              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Ubah Status Armada</h4>
                  <p class="card-category">Ubah Status Armada {{ config('app.name') }}</p>
                </div>
                <div class="card-body">
                  <form action="{{ route('car.changeStatus', $getCar)}}" method="POST">
                   @csrf   
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pilih Status armada</label>
                        <select name="status" class="form-control">
                        <option value="0" @if($getCar->status == "0") selected @endif>Non Aktif</option>
                        <option value="1" @if($getCar->status == "1") selected @endif>Aktif</option>
                        </select>                         
                        </div>
                      
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                    <div class="clearfix"></div>
                    </div>
                  </form>
                </div>
              </div>
@endsection

