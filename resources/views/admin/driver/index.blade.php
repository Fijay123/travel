@extends('template.admin.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Driver {{ config('app.name') }}</h4>
                  <p class="card-category"><div class="float-right"><a class="btn btn-info" href="{{ route('driver.create')}}">Tambah Data</a></div></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>No.</th>
                        <th>Nama </th>
                        <th>Nomor SIM</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Foto</th>
                        <th>Status</th>
                      </thead>
                      <tbody>
                          @php $no=0; @endphp
                    @foreach($driver as $drivers)
                        @php $no++ @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{$drivers->name }}</td>
                          <td>{{$drivers->driver_license}}</td>
                          <td>{{$drivers->address}}</td>
                          <td>{{$drivers->telp}}</td>
                          <td><img src="{{ asset ($drivers->images)}}" style="width:100%;max-width:100px"></td>
                          <td> 
                              @if($drivers->status === 0)
                              <span class="badge badge-danger">Non Aktif</span>
                              @else
                              <span class="badge badge-success">Aktif</span>
                              @endif
                        </td>
                        <td><a href="{{ route('driver.getStatus', $drivers)}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                        <a href="{{ route('driver.edit', $drivers)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                        <button  id="delete" class="btn btn-danger btn-sm" data-title="{{ $drivers->name}}" href="{{ route('driver.destroy', $drivers)}}"><i class="fa fa-trash"></i></button>
                        <a href="{{ route('driver.print', $drivers)}}" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>
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
			  title: "Apakah Kamu Yakin akan Menghapus Driver "+ title+"  ?",
			  text: "Data yang akan dihapus tidak bisa dikembalikan",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	document.getElementById('deleteForm').action = href;
			  	document.getElementById('deleteForm').submit();
			    swal("Data Driver Berhasil Dihapus!", {
			      icon: "success",
			    });
			 	 } 
			});
			})
</script>
@endpush