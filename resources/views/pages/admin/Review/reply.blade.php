@extends('layouts.appUser')
@section('title','Balas pesan')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- isi kontene -->
<h1 class="mb-3">Balas Review Pelanggan</h1>
<form action="{{route('review.update',$item->id)}}" method="POST" class="mt-4">
    @method('PUT')
    @csrf
    <div class="form-floating">
        <textarea class="form-control" name="reply_admin" placeholder="Tinggalkan pesan disini" id="floatingTextarea2" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Balas pesan...</label>
    </div>
    <button class="btn btn-warning mt-3" type="submit">Balas</button>
</form>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

@endsection

