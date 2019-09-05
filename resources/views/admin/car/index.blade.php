@extends('template.admin.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Armada {{ config('app.name') }}</h4>
                  <p class="card-category"><div class="float-right"><a class="btn btn-info" href="{{ route('car.create')}}">Tambah Data</a></div></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>No.</th>
                        <th>Nomor Polisi </th>
                        <th>Tipe</th>
                        <th>Jumlah Kursi</th>
                        <th>Status</th>
                      </thead>
                      <tbody>
                          @php $no=0; @endphp
                    @foreach($car as $cars)
                        @php $no++ @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{$cars->police_number }}</td>
                          <td>{{$cars->type}}</td>
                          <td>{{$cars->seat}}</td>
                          <td> 
                              @if($cars->status === 0)
                              <span class="badge badge-danger">Non Aktif</span>
                              @else
                              <span class="badge badge-success">Aktif</span>
                              @endif
                        </td>
                        <td><a href="{{ route('car.getStatus', $cars)}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                        <a href="{{ route('car.edit', $cars)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                        <button  id="delete" class="btn btn-danger btn-sm" data-title="{{ $cars->police_number }}" href="{{ route('car.destroy', $cars)}}"><i class="fa fa-trash"></i></button>
                        </td>
                        <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE') 
                        <input type="submit" style="display:none">
                      </form>
                        </tr>
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
			  title: "Apakah Kamu Yakin akan Menghapus Armada "+ title+"  ?",
			  text: "Data yang akan dihapus tidak bisa dikembalikan",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	document.getElementById('deleteForm').action = href;
			  	document.getElementById('deleteForm').submit();
			    swal("Data Armada Berhasil Dihapus!", {
			      icon: "success",
			    });
			 	 } 
			});
			})
</script>

@endpush