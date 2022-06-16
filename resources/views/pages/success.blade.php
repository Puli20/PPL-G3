@extends('layouts.app')

@section('title','Success Checkout')

@push('addon-style')
<style>
     h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      .d-flex i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 30px 30px 15px 30px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
</style>
@endpush

@section('content')
<main class="d-flex justify-content-center align-items-center" style="height:90vh">
    <div class="card text-center">
        <div class="d-flex justify-content-center text-center" style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
          <i class="checkmark">✓</i>
        </div>
          <h1>Berhasil</h1>
          <p>Kami menerima pembelian Anda<br/> Mohon menunggu konfirmasi dari kami!</p>
          <a href="{{route('order-history',Auth::user()->id)}}" class="btn btn-primary mt-3">Pesanan Saya</a>
        </div>
</main>

@endsection

