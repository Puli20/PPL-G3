@extends('layouts.app')

@section('title',$item->product_name.'  | Detail Produk')

@push('addon-style')
<style>


.wrapper{
  /* max-width: 1200px; */
  /* margin: auto; */
  padding: 0 20px;
  /* display: flex; */
  /* align-items: center; */
}
.wrapper .box{
  background: #fff;
  width: 100%;
  padding: 0px 15px 10px 15px;
  border-radius: 3px;
  height: auto;
  box-shadow: 0px 4px 8px rgba(0,0,0,0.15);
}
.box{
    transform: none
}
.wrapper .box i.quote{
  font-size: 20px;
  color: #17a2b8;
}
.wrapper .box .content{
  padding-top: 10px;
  word-wrap: break-word;
}
.box .info .name{
  font-weight: 600;
  font-size: 17px;
}
.box .info .job{
  font-size: 16px;
  font-weight: 500;
  color: #17a2b8;
}
.box .info .stars{
  margin-top: 2px;
}
.box .info .stars i{
  color: #17a2b8;
}
.box .content .image{
  height: 75px;
  width: 75px;
  padding: 3px;
  background: #17a2b8;
  border-radius: 50%;
}
.content .image img{
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: 50%;
  border: 2px solid #fff;
}
.box:hover .content .image img{
  border-color: #fff;
}
@media (max-width: 1045px) {
  .wrapper .box{
    width: calc(50% - 10px);
    margin: 10px 0;
  }
}
@media (max-width: 702px) {
  .wrapper .box{
    width: 100%;
  }
}
.rating-component .stars-box .star {
    color: #ccc;
    cursor: pointer;
  }
.rating-component .stars-box .star.selected {
    color: #FFD700;
  }
</style>
@endpush

@section('content')
<main>
    <section class="section-details-header"></section>
    <section class="section-details-contents">
      <div class="container">

        <div class="row">
          <div class="col-md-7 p-0 mb-4">
            <div class="card card-content">
              {{-- @if ($item->gallery->count()) --}}
              <div class="gallery">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        {{-- @foreach ($item->gallery as $item) --}}
                        {{-- @if ($item[0]) --}}
                        <div class="carousel-item active">
                          <img src="{{Storage::url($item->gallery->first()->image)}}" height="400" style="background-size: cover; object-fit: cover" class="d-block w-100" alt="">
                        </div>
                        {{-- @else --}}
                        @if(count($item->gallery) > 1)
                        <div class="carousel-item">
                          <img src="{{Storage::url($item->gallery[1]->image)}}" height="400" style="background-size: cover; object-fit: cover" class=" d-block w-100 " alt="">
                        </div>
                        @if (count($item->gallery) > 2)
                        <div class="carousel-item">
                          <img src="{{Storage::url($item->gallery[2]->image)}}" height="400" style="background-size: cover; object-fit: cover" class=" d-block w-100 " alt="">
                        </div>
                        @endif
                        @if (count($item->gallery) > 3)
                        <div class="carousel-item">
                          <img src="{{Storage::url($item->gallery[3]->image)}}" height="400" style="background-size: cover; object-fit: cover" class=" d-block w-100 " alt="">
                        </div>
                        @endif
                        @if (count($item->gallery) > 4)
                        <div class="carousel-item">
                          <img src="{{Storage::url($item->gallery[4]->image)}}" height="400" style="background-size: cover; object-fit: cover" class=" d-block w-100 " alt="">
                        </div>
                        @endif
                        @if (count($item->gallery) > 5)
                        <div class="carousel-item">
                          <img src="{{Storage::url($item->gallery[5]->image)}}" height="400" style="background-size: cover; object-fit: cover" class=" d-block w-100 " alt="">
                        </div>
                        @endif
                        @endif
                      {{-- @endif --}}
                      {{-- @endforeach --}}
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
              </div>
              {{-- @endif --}}
              {{-- <h2>Tentang Wisata</h2> --}}

            </div>
          </div>
          <div class="col-md-5">
            <div class="card card-detail card-right pb-4">
                <h2 class="mb-2" style="font-size: 30px;">{{ $item->product_name }}</h2>
                <p class="text-muted" style="margin-bottom: 0"><span>Stok</span>&nbsp;{{$item->stock == 0 ? 'habis' : $item->stock}}</p>
              <hr />
              <table class="table table-borderless">
                <tr>
                    <td colspan="2" style="color: rgb(87, 87, 87)">{{ $item->description}}</td>
                  </tr>
                  <form action="{{route('checkout-add-to-cart',$item->id)}}" method="POST">
                        @csrf
                  <tr>
                    <th width="50%" style="line-height: 30px">Jumlah </th>
                    <td class="d-flex justify-content-end">
                        <div class="form" style="width:50%">
                            <input type="number" pattern="[0-9]+" name="order_quantity" class="form-control form-control-sm" required="required">
                        </div>
                      </td>
                  </tr>
                  <tr>
                    <th width="50%">Berat</th>
                    <td class="d-flex justify-content-end">
                            <span id="price">{{ $item->product_weight }}</span> gr
                        </div>
                      </td>
                  </tr>
                <tr>
                  <th width="50%">Harga</th>
                  <td width="50%" class="text-end">
                      Rp <span id="price">{{ $item->price }}</span>
                    </td>
                </tr>

              </table>
            </div>
            @auth
            @if ($item->stock == 0)
            <div class="join-container d-grid gap-2">
                <button disabled class="btn btn-join-now py-2" type="submit">
                  Masukkan Keranjang
                </button>
              </div>
            @else
            <div class="join-container d-grid gap-2">
                <button class="btn btn-join-now py-2" type="submit">
                  Masukkan Keranjang
                </button>
              </div>
            @endif
              </form>
            @endauth
            @guest
            <div class="join-container">
              <a href="{{ route('login') }}" class="btn d-block btn-join-now py-2">Login atau Register terlebih dahulu</a>
            </div>
            @endguest
          </div>
        </div>
      </div>
    </section>
    <div class="reviews-ratings">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h4>Review dan Rating</h4>
                    <div class="wrapper d-flex justify-content-center">
                        <div class="box row">
                            @forelse ($item->review as $item)
                            <div class="col-12 mt-4" style="word-wrap: break-word !important;">
                                <div class="info">
                                    <div class="name">{{$item->user->name }}</div>
                                    {{-- <div class="job">Designer | Developer</div> --}}
                                    <div class="rating-component">
                                        <div class="stars-box">
                                            @if ($item->rate_value === 1)
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            @endif
                                            @if ($item->rate_value === 2)
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            @endif
                                            @if ($item->rate_value === 3)
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            @endif
                                            @if ($item->rate_value === 4)
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star " title="1 stars" data-message="Poor" data-value="1"></i>
                                            @endif
                                            @if ($item->rate_value === 5)
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            <i class="star fa fa-star selected" title="1 stars" data-message="Poor" data-value="1"></i>
                                            @endif
                                        </div>
                                      </div>
                                </div>
                                {{-- <i class="fas fa-quote-left quote mt-2"></i> --}}
                          <div class="mt-2" style="word-wrap: break-word;">
                        <p>    {{$item->comment}}</p>
                        </div>

                            {{-- <div class="image">
                              <img src="images/profile-1.jpeg" alt="">
                            </div> --}}
                          </div>
                          @if ($item->reply_admin != null || $item->reply_admin != '')
                          <hr>
                          <div class="card" style="background-color: rgb(238, 238, 238)">
                              <div class="card-body">
                                  <div class="name">{{$item->user->where('role',1)->first()->name  }}</div>
                                  <div class="mt-2" style="word-wrap: break-word;">
                                    <p>{{$item->reply_admin}}</p>
                                    </div>
                              </div>
                          </div>
                          @endif
                          @empty
                          <h5>Belum ada Review . . . .</h5>
                          <br><br><br>
                          @endforelse
                        </div>
                        {{-- <div class="box">
                          <i class="fas fa-quote-left quote"></i>
                          <p>Lorem aliasry ipsum dolor sits ametans, consectetur adipisicing elitits. Expedita reiciendis itaque placeat thuratu, quasi yiuos repellendus repudiandae deleniti ideas fuga molestiae, alias.</p>
                          <div class="content">
                            <div class="info">
                              <div class="name">Steven Chris</div>
                              <div class="job">YouTuber | Blogger</div>
                              <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                              </div>
                            </div>
                            <div class="image">
                              <img src="images/profile-2.jpeg" alt="">
                            </div>
                          </div>
                        </div> --}}
                        {{-- <div class="box">
                          <i class="fas fa-quote-left  quote"></i>
                          <p>Lorem aliasry ipsum dolor sits ametans, consectetur adipisicing elitits. Expedita reiciendis itaque placeat thuratu, quasi yiuos repellendus repudiandae deleniti ideas fuga molestiae, alias.</p>
                          <div class="content">
                            <div class="info">
                              <div class="name">Kristina Bellis</div>
                              <div class="job">Freelancer | Advertiser</div>
                              <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                              </div>
                            </div>
                            <div class="image">
                              <img src="images/profile-3.jpeg" alt="">
                            </div>
                          </div>
                        </div> --}}
                      </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
