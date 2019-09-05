<div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white" 
    data-image="">
      <div class="logo">
        <a href="" class="simple-text logo-normal">
        {{ config('app.name') }} <br>
        {{ auth::user()->name }}
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ route('member')}}">
            <i class="fa fa-user"></i>
              <p>Member</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ route('car.index')}}">
            <i class="fa fa-car"></i>
              <p>Armada</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{ route('driver.index')}}">
            <i class="fa fa-id-card"></i>
              <p>Driver</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{route ('route.index')}}">
            <i class="fa fa-road"></i>
              <p>Trayek</p></a>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ route('schedule.index')}}">
            <i class="fa fa-subway"></i>
              <p>Jadwal Keberangkatan</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ route('data-booking')}}">
            <i class="fa fa-address-book"></i>
              <p>Data Booking</p>
            </a>
          </li>
           <li class="nav-item ">
            <a class="nav-link" href="{{ route('report')}}">
            <i class="fa fa-address-book"></i>
              <p>Laporan</p>
            </a>
          </li> 
        </ul>
      </div>
    </div>