@extends('layouts.appUser')

@section('title','Dashboard')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Dashboard</h3>
              <p>Selamat Bekerja :3</p>
            </div>
          </div>
        </div>
      </div>
          <div class="row">
            <div class="col-md-3 mb-4  transparent">
              <div class="card shadow ">
                <div class="card-body">
                  <p class="mb-4">Total Transaksi</p>
                  <p class="fs-30 mb-2">{{$total_transaction}}</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-4  transparent">
              <div class="card shadow">
                <div class="card-body">
                  <p class="mb-4">Total Produk</p>
                  <p class="fs-30 mb-2">{{$products}}</p>
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="row">
          </div> --}}



    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

@endsection
