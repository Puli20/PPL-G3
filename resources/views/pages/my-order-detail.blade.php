@extends('layouts.app')

@section('title','Pesanan Detail')

@push('addon-style')
<style>
    .card{
        margin: auto;
        width: 38%;
        max-width:600px;
        padding: 4vh 0;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-top: 3px solid rgb(80, 80, 80);
        border-bottom: 3px solid rgb(80, 80, 80);
        border-left: none;
        border-right: none;
    }
    @media(max-width:768px){
        .card{
            width: 90%;
        }
    }
    .title{
        color: rgb(49, 49, 49);
        font-weight: 600;
        margin-bottom: 2vh;
        padding: 0 8%;
        font-size: initial;
    }
    #details{
        font-weight: 400;
    }
    .info{
        padding: 5% 8%;
        color: rgb(82, 82, 82)
    }
    .info .col-5{
        padding: 0;
    }
    #heading{
        color: grey;
        line-height: 6vh;
    }
    .pricing{
        background-color: #ddd3;
        color: rgb(82, 82, 82);
        padding: 2vh 8%;
        font-weight: 400;
        line-height: 2.5;
    }
    .pricing .col-3{
        padding: 0;
    }
    .total{
        padding: 2vh 8%;
        color: rgb(121, 121, 121);
        font-weight: bold;
    }
    .total .col-3{
        padding: 0;
    }
    .footer{
        padding: 0 8%;
        font-size: x-small;
        color: black;
    }
    .footer img{
        height: 5vh;
        opacity: 0.2;
    }
    .footer a{
        color: rgb(252, 103, 49);
    }
    .footer .col-10, .col-2{
        display: flex;
        padding: 3vh 0 0;
        align-items: center;
    }
    .footer .row{
        margin: 0;
    }

    #progressbar {
        margin-bottom: 3vh;
        overflow: hidden;
        color: rgb(252, 103, 49);
        padding-left: 0px;
        margin-top: 3vh
    }

    #progressbar li {
    list-style-type: none;
    font-size: x-small;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400;
    color: rgb(160, 159, 159);
    }

    #progressbar #step1:before {
        content: "";
        color: rgb(252, 103, 49);
        width: 5px;
        height: 5px;
        margin-left: 0px !important;
        /* padding-left: 11px !important */
    }

    #progressbar #step2:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-left: 0%;
    }

    #progressbar #step3:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-right: 100% ;
        /* padding-right: 11px !important */
    }

    #progressbar #step4:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-right: 100% !important;
        /* padding-right: 11px !important */
    }

    #progressbar li:before {
        line-height: 29px;
        display: block;
        font-size: 12px;
        background: #ddd;
        border-radius: 50%;
        margin: auto;
        z-index: -1;
        margin-bottom: 1vh;
    }

    #progressbar li:after {
        content: '';
        height: 2px;
        background: #ddd;
        position: absolute;
        left: 0%;
        right: 0%;
        margin-bottom: 2vh;
        top: 1px;
        z-index: 1;
    }
    .progress-track{
        padding: 0 10%;
    }
    /* #progressbar li:nth-child(2):after {
        margin-right: auto;
    }

    #progressbar li:nth-child(1):after {
        margin: auto;
    }

    #progressbar li:nth-child(3):after {

        width: 100% !important;
        clear: left;
    }
    #progressbar li:nth-child(4):after {
        margin-left: auto;
        width: 132%;
    } */

    #progressbar  li.active{
        color: black;
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: rgb(128, 128, 36);
    }
</style>
@endpush

@section('content')
<main class="d-flex align-items-center" style="height: 85vh">
    <div class="card">
        <div class="title">Detail Pemesanan</div>
        <div class="info">
            <div class="row">
                <div class="col-7">
                    <span id="heading">Tanggal</span><br>
                    <span id="details">{{$items->transaction_date}}</span>
                </div>
                <div class="col-5 pull-right">
                    <span id="heading">Order No.</span><br>
                    <span id="details">{{$items->invoice_number}}</span>
                </div>
            </div>
        </div>
        <div class="pricing">
            @foreach ($items->transaction_detail as $item)
            <div class="row">
                <div class="col-9">
                    <span id="name">{{$item->product->product_name}}</span>
                </div>
                <div class="col-3">
                    <span id="price">Rp {{$item->product->price}}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="total mb-3">
            <div class="row">
                <div class="col-9">Total</div>
                <div class="col-3"><big>Rp {{$items->transaction_total}}</big></div>
            </div>
        </div>
        <div class="tracking">
            <div class="title">Detail Pengiriman</div>
            <div class="container" style="padding: 0 42px; font-size: 13px; color: rgb(73, 73, 73)">
                <div class="row">
                    <div class="col-auto ms-1">
                        <div>No. Resi : {{$items->expedition != null ? $items->expedition->no_resi : ' Belum di Upload'}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress-track">
            <ul id="progressbar">
                @if ($items->transaction_status == 'PENDING' )
                <li class="step0 active " id="step1">Dipesan</li>
                <li class="step0 " id="step2">Dikemas</li>
                <li class="step0 " id="step3">Dikirim</li>
                <li class="step0 " id="step4">Diterima</li>
                @endif
                @if ($items->transaction_status == 'PROCESS')
                <li class="step0 active " id="step1">Dipesan</li>
                <li class="step0 active" id="step2">Dikemas</li>
                <li class="step0 " id="step3">Dikirim</li>
                <li class="step0 " id="step4">Diterima</li>

                @endif
                @if ($items->transaction_status == 'SENT')
                <li class="step0 active " id="step1">Dipesan</li>
                <li class="step0 active" id="step2">Dikemas</li>
                <li class="step0 active" id="step3">Dikirim</li>
                <li class="step0" id="step4">Diterima</li>
                @endif
                @if ($items->transaction_status == 'SUCCESS')
                <li class="step0 active " id="step1">Dipesan</li>
                <li class="step0 active" id="step2">Dikemas</li>
                <li class="step0 active" id="step3">Dikirim</li>
                <li class="step0 active" id="step4">Diterima</li>
                @endif
            </ul>
        </div>
        {{-- <div class="footer">
            <div class="row">
                <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/YBWc55P.png"></div>
                <div class="col-10">Want any help? Please &nbsp;<a> contact us</a></div>
            </div>
        </div> --}}
    </div>
</main>

@endsection

