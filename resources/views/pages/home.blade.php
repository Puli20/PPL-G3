@extends('layouts.app')

@section('title','Graha Asri')


@section('content')
<main>
    <section id="header">
      <img src="{{url('frontend/assets/img/header-bg.jpg')}}" class="img-fluid" alt="">
      <div class="content text-center">
          <h1>Graha Asri</h1>
          <p>Awali Hari Dengan Rasa Yang Luar Biasa.</p>
      </div>
  </section>
  <section id="product-list" style="background-color: rgb(240, 240, 240)">
    <div class="container">
        <div class="row py-5">
            <h2 class="text-center mb-5" style="color: rgb(61, 61, 61);font-size: 38px; font-weight: 600;">Produk Kami</h2>
            @foreach ($products as $product)
            <div class="col-md-3">
                <a href="{{route('detail', $product->id)}}" class="text-decoration-none card-product" style="color: rgb(61, 61, 61)">
                    <div class="card card-product" >
                        <img src="{{Storage::url($product->gallery->first()->image)}}" class="card-img-top" style="background-size: cover; object-fit: cover;" height="220" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $product->product_name }}</h5>
                          <div class="card-price-rating d-flex">
                              <p class="card-text me-2" style="margin-bottom: 7px">Rp <span id="price-product">{{ $product->price }}</span></p>
                              <span>|</span>
                              <div  class="ms-2"><span id="star">{{$product->review->count() != 0 ? $product->review->avg('rate_value') : 0}}</span><i style="color:yellow" class="fa-solid fa-star"></i></div>
                          </div>
                          <a href="{{route('detail', $product->id)}}" class="btn btn-sm btn-warning">Detail</a>
                        </div>
                      </div>
                </a>
            </div>
            @endforeach
            <div class="d-flex justify-content-center mt-5 ">
                <a href="{{route('all-product')}}" class="shadow btn btn-dark px-5 py-2 rounded-2">Lebih Banyak</a>
            </div>
        </div>

    </div>
  </section>
</main>
@endsection
