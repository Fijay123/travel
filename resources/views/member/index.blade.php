@extends('template.admin.template')
@section('content')

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Data Member {{ config('app.name') }}</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>No.</th>
                        <th>Nama </th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telp</th>
                        <th>Tanggal Bergabung</th>
                      </thead>
                      <tbody>
                          @php $no=0; @endphp
                    @foreach($member as $members)
                        @php $no++ @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{$members->name}}</td>
                          <td>{{$members->address}}</td>
                          <td>{{$members->email}}</td>
                          <td>{{$members->phone}}</td>
                          <td>{{ Date::parse($members->created_at)->format('j F Y')}}</td>
                                             
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#confirm_delete").submit(function(event) {
            event.preventDefault();
            swal({
                title: 'Apakah Kamu Yakin Akan Menghapus Data ini?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: true
            }).then(function() {
                    $("#confirm_delete").off("submit").submit();
            }, function(dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal('Cancelled', 'Delete Cancelled :)', 'error');
                }
            })
        });
    });

    
</script>
@include('sweet::alert')

@endpush