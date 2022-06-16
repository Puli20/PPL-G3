@extends('layouts.app')

@section('title','Graha Asri')

@push('addon-style')
<style>
        .payment-form{
        padding-bottom: 50px;
        font-family: 'Montserrat', sans-serif;
    }


    .payment-form .content{
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
        background-color: white;
    }

    .payment-form .block-heading{
        padding-top: 30px;
        margin-bottom: 30px;
        /* text-align: center; */
    }

    .payment-form .block-heading p{
        /* text-align: center; */
        max-width: 420px;
        /* margin: auto; */
        opacity:0.7;
    }

    .payment-form.dark .block-heading p{
        opacity:0.8;
        margin-bottom: 0;
    }

    .payment-form .block-heading h1,
    .payment-form .block-heading h2,
    .payment-form .block-heading h3 {
        margin-bottom:1.2rem;
        color: #3b99e0;
    }

    /* .payment-form form{
        border-top: 2px solid #5ea4f3;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
        background-color: #ffffff;
        padding: 0;
        max-width: 642px;
        /* margin: auto; */
    } */

    .payment-form .title{
        font-size: 1em;
        color: rgb(75, 75, 75);
        border-bottom: 1px solid rgba(0,0,0,0.1);
        font-weight: 600;
        padding-bottom: 8px;
    }

    .payment-form .products{
        /* background-color: #dfdfdf; */
        /* border-top:3px solid #3b99e0; */
        margin-top:40px;
        /* padding: 25px; */
    }

    .payment-form .products .item{
        margin-bottom:1em;
    }

    .payment-form .products .item-name{
        font-weight:500;
        font-size: 0.9em;
    }

    .payment-form .products .item-description{
        font-size:0.8em;
        opacity:0.6;
    }

    .payment-form .products .item p{
        margin-bottom:0.2em;
    }

    .payment-form .products .price{
        float: right;
        font-weight: 500;
        font-size: 0.9em;
    }

    .payment-form .products .total{
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        margin-top: 10px;
        padding-top: 19px;
        font-weight: 600;
        line-height: 1;
    }

    .payment-form .card-details{
        /* padding: 25px 25px 15px; */
        margin-top: 40px
    }

    .payment-form .card-details label{
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #79818a;
        text-transform: uppercase;
    }

    .payment-form .card-details button{
        margin-top: 0.6em;
        padding:12px 0;
        font-weight: 600;
    }

    .payment-form .date-separator{
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 5px;
    }

    @media (min-width: 576px) {
        .payment-form .title {
            font-size: 1.2em;
        }

        /* .payment-form .products {
            padding: 40px;
        } */

        .payment-form .products .item-name {
            font-size: 1em;
        }

        .payment-form .products .price {
            font-size: 1em;
        }

        /* .payment-form .card-details {
            padding: 40px 40px 30px;
        } */

        .payment-form .card-details button {
            margin-top: 2em;
        }
    }

      .payment-instruction {
    font-size: 13px;
    font-weight: light;
    color: #afafaf;
  }
  .payment-gateway {
    .rekenings {
      h3 {
        font-size: 16px;
        color: #071c4d;
        font-weight: 400;
      }
    }
  }
  .payment-gateway .rekenings h3{
    font-size: 16px;
        color: #071c4d;
        font-weight: 400;
  }

  /* aplod animated */


</style>
@endpush

@section('content')
<main  class="page payment-page">
        <section class="payment-form dark">
          <div class="container">
              <div class="row">
                  <div class="col-md-7">
                      <div class="products card shadow-sm">
                          <div class="card-body">
                              <h3 class="title mb-3">Informasi Checkout</h3>
                              @foreach ($items as $item)
                              <div class="item border-top">
                                <span class="price">Rp {{$item->product->price}}</span>
                                <p class="item-name">{{$item->product->product_name}}</p>
                                <p class="item-description">{{$item->order_quantity}}x</p>
                              </div>
                              @endforeach
                              <div class="total">Total<span class="price">Rp {{$items->first()->transaction->transaction_total}}</span></div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-5">
                    <div class="card-details card shadow-sm">
                        <div class="card-body">
                            <h3 class="title">Pembayaran</h3>
                            <p class="payment-instruction">
                                Dapat memilih salah satu metode
                            </p>
                                <div class="payment-gateway d-flex align-items-center">
                                <img
                                    src="{{url('frontend/assets/img/icon_dana.png')}}"
                                    height="45"
                                    width="71"
                                    alt="bank"
                                />
                                <div class="rekenings ms-3">
                                    <h3>Pradana Febrian Murtadlo</h3>
                                    <h3>08995135447</h3>
                                    <h3>Dana</h3>
                                </div>
                            </div>
                            <div class="payment-gateway d-flex mt-2 align-items-center">
                                <img
                                src="{{url('frontend/assets/img/mandiri_icon.png')}}"
                                    height="45"
                                    alt="bank"
                                />
                                <div class="rekenings ms-4">
                                    <h3>Pradana Febrian Murtadlo</h3>
                                    <h3>1430021035165</h3>
                                    <h3>Mandiri</h3>
                                </div>
                            </div>
                            <form action="{{route('checkout-payment-process-send',$items->first()->transaction->id)}}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <label for="" class="mt-3" style="margin-bottom: 0">Upload Bukti Pembayaran Disini</label>
                            <div class="input-group mt-2">
                                    <input required type="file" name="proof_of_transaction" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"  aria-label="Upload">
                                  </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Saya Sudah melakukan pembayaran</button>
                                  </div>
                                </form>
                        </div>
                    </div>
                  </div>
              </div>


          </div>
        </section>
</main>

@endsection

