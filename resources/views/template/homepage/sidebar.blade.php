<div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white" data-image="">
      
      <div class="logo">
        <a href="" class="simple-text logo-normal">
        {{ config('app.name') }}
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          
          <li class="nav-item ">
            <a class="nav-link" href="{{ route('index')}}">
            <i class="fa fa-subway"></i>
              <p>Jadwal Keberangkatan</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{ route('dataBooking', Auth::user()->id)}}">
            <i class="fa fa-book"></i>
              <p>Data Booking</p>
            </a>
          </li>
         
        </ul>
      </div>
    </div>