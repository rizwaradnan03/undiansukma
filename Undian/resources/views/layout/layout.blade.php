<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="icon" href="{{asset('img/sukma_icon_leaflet.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('asset/leaflet/leaflet.css')}}"/>
    <link href="{{asset('asset/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/datatables/DataTables-1.13.4/css/jquery.dataTables.css')}}" />
    <style>
      *{
        font-family: sans-serif;
      }
    </style>
    @yield('css')
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand text-dark ml-2" href="{{url('/')}}"><img src="{{asset('img/sukma_navbar.png')}}"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{url('/')}}">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{url('/hadiah')}}">Hadiah</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{url('/pemenang')}}">Pemenang Undian</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{url('/lokasi')}}">Lokasi Kami</a>
          </li>
          @if (Auth::user())
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{url('/undian')}}">Undi</a>
          </li>
          @endif
          <li class="nav-item">
            @if (Auth::user())
            <a class="nav-link text-dark" href="{{url('/getLogout')}}">Logout</a>
            @else
            <a class="nav-link text-dark" href="{{url('/login')}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</a>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>
    @if ($gagal = Session::get('gagal'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{$gagal}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($haruslogin = Session::get('haruslogin'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{$haruslogin}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($berhasil = Session::get('berhasil'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{$berhasil}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container">
        @yield('content')
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{url('/postLogin')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group mb-3">
                <label for="username">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" autofocus>
              </div>
              <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>
<script src="{{asset('asset/highcharts/code/highcharts.js')}}"></script>
<script src="{{asset('asset/leaflet/leaflet.js')}}"></script>
<script src="{{asset('asset/js/popper.min.js')}}"></script>
<script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
<script src="{{asset('asset/js/jquery.min.js')}}"></script>
<script src="{{asset('asset/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('asset/js/sweetalert.min.js')}}"></script> 
<script src="{{asset('asset/datatables/DataTables-1.13.4/js/jquery.dataTables.js')}}"></script>
@yield('js')
</html>