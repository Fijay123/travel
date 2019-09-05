@extends('template.admin.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Jadwal {{ config('app.name') }}</h4>
                  <p class="card-category"><div class="float-right"><a class="btn btn-info" href="{{ route('schedule.create')}}">Tambah Data</a></div></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                      <th>No</th>
                        <th>Tanggal Berangkat</th>
                        <th>Armada</th>
                        <th>Jumlah Seat</th>
                        <th>Sisa Seat</th>
                        <th>Trayek</th>
                        <th>Driver</th>
                        <th>Harga Tiket</th>
                        <th>Status</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                      @php $no=0; @endphp
                        @foreach($schedule as $schedules)
                            @php $no++; @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ Date::parse($schedules->date_departure)->format('l, j F Y') }}</td>
                            <td>{{ $schedules->car->type}}({{ $schedules->car->police_number}})</td>
                            <td>{{ $schedules->seat}}</td>
                            <td>{{ $seat->seat($schedules->id)->count() }}</td>
                            <td>{{ $schedules->route->departure}}-{{ $schedules->route->destination}}({{ $schedules->route->time_departure}})</td>
                            <td>{{ $schedules->driver->name}}</td>
                            <td>{{ number_format($schedules->price) }}</td>
                          <td> 
                              @if($schedules->status === 0)
                              <span class="badge badge-danger">Non Aktif</span>
                              @else
                              <span class="badge badge-success">Aktif</span>
                              @endif
                                
                        </td>
                        <td><a href="{{ route('schedule.getStatus', $schedules)}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                        <a href="{{ route('schedule.edit', $schedules)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                        <button  id="delete" class="btn btn-danger btn-sm" data-title="{{ $schedules->route->departure}} - {{ $schedules->route->destination}}" href="{{ route('schedule.destroy', $schedules)}}"><i class="fa fa-trash"></i></button>
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
			  title: "Apakah Kamu Yakin akan Menghapus Jadwal "+ title+"  ?",
			  text: "Data yang akan dihapus tidak bisa dikembalikan",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	document.getElementById('deleteForm').action = href;
			  	document.getElementById('deleteForm').submit();
			    swal("Data Jadwal Berhasil Dihapus!", {
			      icon: "success",
			    });
			 	 } 
			});
			})
</script>
@endpush