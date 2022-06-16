@extends('layouts.app')

@section('title','Shopping Cart')

@section('content')
<main>
    <div class="wrapper mt-4">
        @if ($message = Session::get('error'))
        <div class="alert alert-warning" role="alert">
            {{ $message }}
     </div>
            @endif
		<div class="project">
			<div class="shop">
                @forelse ($items as $item)
				<div class="box">
					<img src="{{Storage::url($item->product->gallery->first()->image)}}" alt="image" style="width: 230px">
					<div class="content">
						<h3>{{ $item->product->product_name }}</h3>
						<h4>Harga : Rp {{ $item->product->price }}</h4>
						<p class="unit">
                            Jumlah :&nbsp;
                            <span id="order_quantity">{{$item->order_quantity}}</span>
                            <span id="detail-id" hidden>{{$item->id}}</span>
                             <!-- Button trigger modal -->
                             <button type="button" id="button-modal" style="background-color: rgb(228, 228, 228)" class="ms-2 btn shadow btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Edit
                             </button>
                            </p>
                        <form action="{{route('remove',$item->id)}}" method="get">
                            <button type="submit" class="btn-area"><i aria-hidden="true" class="fa fa-trash"></i> <span class="btn2">Remove</span></button>
                        </form>
					</div>
				</div>
                @empty
                <h2>Tidak ada produk dalam keranjang</h2>
                @endforelse

			</div>
            @if ($items != [])
			<div class="right-bar">
                <p><span>Total Berat</span> <span>{{count($items)? $items->first()->transaction->total_weight : 0}} gr</span></p>
                {{-- <hr> --}}
				<hr>
				{{-- <p><span>Shipping</span> <span>$15</span></p> --}}
				{{-- <hr> --}}
				{{-- <p><span>Total</span> <span>Rp {{$item->transaction->transaction_total}}</span></p> --}}
				<p><span>Total</span> <span>Rp {{count($items)? $items->first()->transaction->transaction_total : 0 }}</span></p><a href="{{route('checkout-payment-process',$items->first()->transaction->id)}}"><i class="fa fa-shopping-cart"></i>Checkout</a>
			</div>
            @else
            <div class="right-bar">
                <p><span>Total Berat</span> <span>0 gr</span></p>
                {{-- <hr> --}}
				<hr>
				{{-- <p><span>Shipping</span> <span>$15</span></p> --}}
				{{-- <hr> --}}
				{{-- <p><span>Total</span> <span>Rp {{$item->transaction->transaction_total}}</span></p> --}}
				<p><span>Total</span> <span>Rp  0 </span></p><a href="#"><i class="fa fa-shopping-cart"></i>Checkout</a>
			</div>
            @endif
		</div>
	</div>
       <!-- Modal -->
       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Jumlah Barang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="editForm">
                @csrf
            <div class="modal-body">
                <label for="">Jumlah</label>
                <input type="number" name="order_quantity" class="form-control" id="order_quantity_update">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button  class="btn btn-primary" type="submit">Save changes</button>
        </div>
            </form>
        </div>
        </div>
    </div>

</main>
@endsection

@push('addon-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        const orderQuantity = document.querySelectorAll('#button-modal')
        orderQuantity.forEach(button => {
            button.onclick = (e)=>{
                const order_quantity = $(e.target).siblings().first().html()
                const detail_id = $(e.target).siblings().eq(1).html()
                console.log(detail_id)
                $('#order_quantity_update').val(order_quantity)
                $('#editForm').attr('action', `/checkout/cart/update/${detail_id}`);
            }
        });
    })
</script>
@endpush
