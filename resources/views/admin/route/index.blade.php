@extends('template.admin.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Trayek {{ config('app.name') }}</h4>
                  <p class="card-category"><div class="float-right"><a class="btn btn-info" href="{{ route('route.create')}}">Tambah Data</a></div></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>No.</th>
                        <th>Kota Asal </th>
                        <th>Kota Tujuan</th>
                        <th>Jam Keberangkatan</th>
                        <th>Titik Kumpul</th>
                        <th>Status</th>
                      </thead>
                      <tbody>
                          @php $no=0; @endphp
                    @foreach($route as $routes)
                        @php $no++ @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{$routes->departure}}</td>
                          <td>{{$routes->destination}}</td>
                          <td>{{ Date::parse($routes->time_departure)->format('H:i')}}</td>
                          <td>{{$routes->meeting_point}}</td>
                          <td> 
                              @if($routes->status === 0)
                              <span class="badge badge-danger">Non Aktif</span>
                              @else
                              <span class="badge badge-success">Aktif</span>
                              @endif
                                
                        </td>
                        <td><a href="{{ route('route.getStatus', $routes)}}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                        <a href="{{ route('route.edit', $routes)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                        <button  id="delete" class="btn btn-danger btn-sm" data-title="{{ $routes->departure }} - {{ $routes->destination }} " href="{{ route('route.destroy', $routes)}}"><i class="fa fa-trash"></i></button>
                      </td>
                        </tr>
                        <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE') 
                        <input type="submit" style="display:none">
                      </form>
                    @endforeach        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
           
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')

<script>
	$('button#delete').on('click', function() {
		var href = $(this).attr('href');
		var title = $(this).data('title');

		swal({
			  title: "Apakah Kamu Yakin akan Menghapus Trayek "+ title+"  ?",
			  text: "Data yang akan dihapus tidak bisa dikembalikan",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	document.getElementById('deleteForm').action = href;
			  	document.getElementById('deleteForm').submit();
			    swal("Data Trayek Berhasil Dihapus!", {
			      icon: "success",
			    });
			 	 } 
			});
			})
</script>

@endpush