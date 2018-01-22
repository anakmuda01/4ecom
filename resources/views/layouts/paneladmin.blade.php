<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ecom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kategori
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Nasi Bungkus</a>
                    <a class="dropdown-item" href="#">Nasi Kotak</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Kue</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Snack</a>
                  </div>
                </li>
              </ul>
              <form method="GET" action="/produk" class="form-inline d-flex mx-auto caribox">
                <input name="cari" class="form-control mr-sm-2" type="text" placeholder="Cari produk ..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>

                <ul class="navbar-nav ml-auto">
              @if(Auth::guest() || Auth::user()->role!=2)
                  <li class="nav-item mx-2">
                    <a href="#" class="nav-link">
                      <i class="fa fa-bell-o" aria-hidden="true"></i>
                      <span class="nomor"> 5 </span><span>Notifikasi</span>
                    </a>
                  </li>
                  <li class="nav-item mx-3">
                    <a href="#" class="nav-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="nomor">  5</span></a>
                  </li>
              @endif

                    @if(Auth::guest())
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @elseif (Auth::user()->role==2)
                      <li class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                             aria-haspopup="true" aria-expanded="false">
                              Admin
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                              <a href="/admin" class="dropdown-item">
                                Admin Panel
                              </a>
                              <a href="{{ route('logout') }}" class="dropdown-item"
                                 onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </div>
                      </li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->email }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a href="/profile" class="dropdown-item">
                                  Profile
                                </a>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>
    <div class="content">
      @yield('content')
    </div>
    <br>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/sholihin.js') }}"></script>
{{-- <script src="{{asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script> --}}

</body>
</html>
