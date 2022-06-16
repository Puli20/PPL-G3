<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- CDN bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Fontawesome -->
  <link rel="stylesheet" href="{{url('frontend/assets/fontawesome/css/all.css')}}">
  <link rel="stylesheet" href="{{url('frontend/assets/css/style-cart.css')}}">
  <!-- CSS Style -->
  <link rel="stylesheet" href="{{ url('frontend/assets/css/style.css') }}">
  @stack('addon-style')
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{route('home')}}">
          <img src="{{ url('frontend/assets/img/lOGO.png') }}" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarNavDropdown">
          @guest
            <form action="" class="ms-auto">
              <button type="submit" class="btn-danger btn" onclick="event.preventDefault(); location.href='{{url('/login')}}'">Masuk</button>
            </form>
          @if (Route::has('register'))
            <form action="" class="me-3">
              <button type="submit" class="btn btn-outline-dark" onclick="event.preventDefault(); location.href='{{url('/register')}}'" style="outline: none; color:white">Daftar</button>
            </form>
          @endif

          @else
          <div class="cart ms-auto me-3" >
            <a href="{{route('cart')}}" style="color:white" title="Keranjang Belanja">
                <i class="fa-solid fa-cart-shopping fa-xl"></i>
            </a>
          </div>
            <div class="dropdown">
              <a class="dropdown-toggle text-decoration-none ms-auto" style="color: white" type="button" id="dropdownLogout" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownLogout">
                  <li>
                    <a href="{{route('order-history',Auth::user()->id)}}" class="dropdown-item">
                        Pesanan Saya
                    </a>
                  </li>
                  @if (Auth::user()->role == 0)
                  <li>
                      <a href="{{route('profil')}}" class="dropdown-item">
                          Profil
                      </a>
                  </li>
                  @endif
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                        {{ __('Keluar') }}
                  </a>
                </li>
              </ul>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          @endguest

      </div>
    </div>
  </nav>

  <!-- Content -->
  @yield('content')
  <!-- End Content -->

  <!-- javascript -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@stack('addon-script')
  </body>
</html>
