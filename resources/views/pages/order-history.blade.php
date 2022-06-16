@extends('layouts.app')

@section('title','Pesanan Saya')

@push('addon-style')
<style>
        body{
    background:#eee;
    }
    .panel-order .row {
        border-bottom: 1px solid #ccc;
    }
    .panel-order .row:last-child {
        border: 0px;
    }
    .panel-order .row .col-md-1  {
        text-align: center;
        padding-top: 15px;
    }
    .panel-order .row .col-md-1 img {
        width: 50px;
        max-height: 50px;
    }
    .panel-order .row .row {
        border-bottom: 0;
    }
    .panel-order .row .col-md-12 {
        border-left: 1px solid #ccc;
    }
    .panel-order .row .row .col-md-12 {
        padding-top: 7px;
        padding-bottom: 7px;
    }
    .panel-order .row .row .col-md-12:last-child {
        font-size: 11px;
        color: #555;
        background: #efefef;
    }
    .panel-order .btn-group {
        margin: 0px;
        padding: 0px;
    }
    .panel-order .panel-body {
        padding-top: 0px;
        padding-bottom: 0px;
    }
    .panel-order .panel-deading {
        margin-bottom: 0;
    }
    .label-success{
        padding: 5px 10px;
        background-color: #19945a;
        color:white;
        border-radius: 5px;
        font-size: 12px;
    }
    .label-danger{
        padding: 5px 10px;
        background-color: #bb2d3b;
        color:white;
        border-radius: 5px;
        font-size: 12px;
    }
    .label-info{
        padding: 5px 10px;
        background-color: #1abbdb;
        color:white;
        border-radius: 5px;
        font-size: 12px;
    }
</style>
@endpush

@section('content')
<main>
    <div class="container bootdey  mt-3 ">
        <div class="panel panel-default panel-order">
            <div class="panel-heading mb-3">
                <strong>Pesanan Saya</strong>

            </div>

            <div class="panel-body">
                @forelse ($items as $item)
                <div class="row">
                    <div class="col-md-12 bg-light">
                        <div class="row">
                            <div class="col-md-12">
                                @if($item->transaction_status == 'PENDING')
                                    <div class="float-end"><label class="label label-info">
                                        Menunggu Verifikasi
                                    </label></div>
                                @endif
                                @if($item->transaction_status == 'SENT')
                                <div class="float-end"><label class="label label-info">
                                    Dikirim
                                </label></div>
                                @endif
                                @if($item->transaction_status == 'PROCESS')
                                <div class="float-end"><label class="label label-info">
                                    Diproses
                                </label></div>
                                @endif
                                @if($item->transaction_status == 'SUCCESS')
                                <div class="float-end"><label class="label label-success">
                                    Diterima
                                </label></div>
                                @endif
                                @if($item->transaction_status == 'FAILED')
                                <div class="float-end"><label class="label label-danger">
                                    Dibatalkan
                                </label></div>
                                @endif
                                <span><strong>No. Pesanan : </strong></span> <span class="label">{{$item->invoice_number}}</span><br />
                                Jumlah : {{$item->transaction_detail->count()}}, Total Harga: Rp {{$item->transaction_total}} <br />
                                <div class="button d-flex mt-2">
                                    <a href="{{route('my-order-detail',$item->id)}}" class="btn btn-info btn-sm me-2">Detail</a>

                                    @if ($item->proof_of_transaction == null)
                                    <a href="{{route('checkout-payment-process-send',$item->id)}}" class="btn btn-success btn-sm me-2">Upload Bukti Pembayaran</a>
                                    @endif

                                    @if ($item->transaction_status != 'PENDING' &&  $item->transaction_status != 'PROCESS' && $item->transaction_status != 'SUCCESS' && $item->transaction_status != 'FAILED' && $item->transaction_status != 'IN_CART')
                                    <form action="{{route('my-order-done',$item->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-success">Diterima</button>
                                    </form>
                                    @endif
                                    @if ($item->transaction_status == 'SUCCESS' && !empty($item->transaction_detail->where('review_status',0)) )
                                    <a href="{{route('list-product-review',$item->id)}}" class="btn btn-dark btn-sm">Ulasan</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 bg-light"></div>
                        </div>
                    </div>
                </div>
                @empty
                <h2>Belum ada pesanan</h2>
                @endforelse
            </div>
        </div>
    </div>
</main>

@endsection

