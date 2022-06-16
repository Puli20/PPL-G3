<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title') | Admin</title>
  {{-- lightbox --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{url('template/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{url('template/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{url('template/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{url('template/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{url('template/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('template/js/select.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{url('template/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{url('frontend/assets/fontawesome/css/all.css')}}">

  <!-- End plugin css for this page -->
  <!-- Fontawesome -->
  <link rel="stylesheet" href="{{url('frontend/assets/fontawesome/css/all.css')}}">
  <!-- inject:css -->
  <link rel="stylesheet" href="{{url('template/css/vertical-layout-light/style.css')}}">
  {{-- my Css --}}
  <link rel="stylesheet" href="{{ url('frontend/assets/css/style.css') }}">
  <!-- endinject -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  {{-- <link rel="shortcut icon" href="{{url('template/images/favicon.png')}}" /> --}}
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{route('dashboard')}}"><img src="{{url('frontend/assets/img/logo-dark.png')}}" class="mr-2" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        {{-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button> --}}

        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{url('frontend/assets/img/noprofil.jpg')}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="{{route('profil-admin',Auth::user()->id)}}" class="dropdown-item">
                <i class="fa-solid fa-circle-user"></i>
                Profil
              </a>
              <form action="{{route('logout')}}" method="POST" >
                @csrf
                 <button class="dropdown-item" type="submit">
                  <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout
                 </button>
              </form>
            </div>
          </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('data-pembeli')}}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Data Pembeli</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"
            {{-- href="{{route('data-produk.index')}}"  --}}
             data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Produk</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{route('data-produk.index')}}">Data Produk</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('gallery.index')}}">Gallery</a></li>
                </ul>
              </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('transaction.index')}}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Transaksi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('report')}}" style="padding: 6px 16px;">
              <i class="mdi mdi-calendar-blank" style="font-size: 1rem;margin-right: 1rem"></i>
              <span class="menu-title">Laporan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('modal-produksi.index')}}" style="padding: 6px 16px;">
              <i class="mdi mdi-calendar-blank" style="font-size: 1rem;margin-right: 1rem"></i>
              <span class="menu-title">Modal Produksi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('review.index')}}" style="padding: 6px 16px;">
              <i class="mdi mdi-comment " style="font-size: 1rem;margin-right: 1rem"></i>
              <span class="menu-title">Ulasan</span>
            </a>
          </li>

        </ul>
      </nav>
      <!-- partial -->
     @yield('content')
     {{-- <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
        </div>
      </footer> --}}
      <!-- partial -->
    </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{url('template/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{url('template/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{url('template/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{url('template/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{url('template/js/dataTables.select.min.js')}}"></script>

  <!-- End plugin js for this page -->
  {{-- lightbox --}}
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- inject:js -->
  <script src="{{url('template/js/dataTables.select.min.js')}}"></script>
  <script src="{{url('template/js/hoverable-collapse.js')}}"></script>
  <script src="{{url('template/js/template.js')}}"></script>
  <script src="{{url('template/js/settings.js')}}"></script>
  <script src="{{url('template/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{url('template/js/dashboard.js')}}"></script>
  <script src="{{url('template/js/Chart.roundedBarCharts.js')}}"></script>
  <!-- End custom js for this page-->
  @stack('addon-script')
  <script>
      $('.nav').on('click','.nav-item', function(){
          $(this).addClass('active')
          console.log(this)
      })
  </script>
</body>

</html>

