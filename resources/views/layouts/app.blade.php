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
                    <a class="dropdown-item" href="/produk/kategori/nasi_bungkus">Nasi Bungkus</a>
                    <a class="dropdown-item" href="/produk/kategori/nasi_kotak">Nasi Kotak</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/produk/kategori/snack">Snack</a>
                  </div>
                </li>
              </ul>
              <form method="GET" action="/produk" class="form-inline d-flex mx-auto caribox">
                <input name="cari" class="form-control mr-sm-2" type="text" placeholder="Cari produk ..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>

                <ul class="navbar-nav ml-auto">
              @if(!empty(Auth::user()))
                @if (Auth::user()->role!=2)
                  <li class="nav-item mx-2">
                    <a href="/pembayaran" class="nav-link">
                      <i class="fa fa-bell-o" aria-hidden="true"></i>
                      <span class="nomor">
                        @if (!Auth::user()->pesans->first())
                          0
                        @elseif (Auth::user()->pesans->first()->pivot->where(['status'=> 2,'user_id'=>Auth::user()->id])->first())
                          {{Auth::user()->pesans->count()}}
                        @else
                          0
                        @endif
                      </span>
                    </a>
                  </li>
                  <li class="nav-item mx-3">
                    {{-- <button type="button" class="btn btn-primary">
                      Profile <span class="badge badge-light">9</span>
                      <span class="sr-only">unread messages</span>
                    </button> --}}
                    <a href="/keranjang" class="btn btn-success nav-link">
                      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                      <span class="tombol-cart">&nbsp;Keranjang&nbsp;
                      </span><span class="badge badge-danger cart-num">
                      @if(!Auth::user()->cart)
                        0
                      @elseif (Auth::user()->cart->where(['user_id'=>Auth::user()->id,'status'=> 1])->first())
                      {{-- @elseif (Auth::user()->cart->where('status', 1)->first()) --}}
                        {{Auth::user()->cart->cartItems->count()}}
                      @else
                        0
                      @endif
                      </span>
                    </a>
                  </li>
                @endif
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

    {{-- <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <p class="text-center text-muted">&copy; 2018 Kelompok 4 E-Commerce Kelas 5C Reguler Pagi Banjarbaru</p>
          </div>
        </div>
      </div>
    </footer> --}}
  <footer class="mainfooter" role="contentinfo">
    <div class="footer-top p-y-2">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="footer-title text-xs-center">
              <h4 class="p-b-1">Contact Us</h4>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6">
          <!--Column1-->
          <div class="footer-pad">
            <h4>About</h4>
            <address>
                  <ul class="list-unstyled">
                    <li>
                      Cathering Online Shop<br>
                      Projek UAS Fathurrahman Sholihin<br>
                      Visual 3<br>
                    </li>
                  </ul>
                </address>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <!--Column1-->
          <div class="footer-pad">
            <h4>Alamat</h4>
            <address>
  								<ul class="list-unstyled">
  									<li>
                      UNISKA BANJARBARU<br>
  										Kelas 5C Reg Pagi<br>
  										Visual 3<br>
  									</li>
  									<li>
  										Phone: 085247711065
  									</li>
  								</ul>
  							</address>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <!--Column1-->
          <div class="footer-pad">
            <h4>Website Information</h4>
            <ul class="list-unstyled">
              <li><a href="#">Website Tutorial</a></li>
              <li><a href="#">Accessibility</a></li>
              <li><a href="#">Disclaimer</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">FAQs</a></li>
              <li><a href="#">Webmaster</a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <!--Footer Bottom-->
            <p class="text-center">&copy; 2018 Fathurrahman Sholihin 15630674</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/sholihin.js') }}"></script>
{{-- <script src="{{asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script> --}}

@if(session('msg'))
  <script>
    $("#myModal").modal("show");
  </script>
@endif

</body>
</html>
