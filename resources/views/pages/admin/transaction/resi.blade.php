
@extends('layouts.appUser')
@section('title','Resi')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <!-- isi kontene -->
<h1>Expedisi & Resi</h1>
<form action="{{route('Store-Form-Expedition',$item->id)}}" method="POST">
    @csrf
    <div class="mb-3 mt-4">
        <label for="exampleFormControlInput1" class="form-label">Expedisi</label>
        <div class="pembatas" style="width: 50%">
            <input required type="text" class="form-control form-control-sm" name="expedition_name" id="exampleFormControlInput1" placeholder="JnT, JNE">
        </div>
      </div>
    <div class="mb-3 mt-4">
        <label for="exampleFormControlInput2" class="form-label">Resi</label>
        <div class="pembatas" style="width: 50%">
            <input type="text" required class="form-control form-control-sm" name="no_resi" id="exampleFormControlInput2" placeholder="01923894">
        </div>
      </div>
      <button class="btn btn-primary">Tambah</button>
</form>

    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

@endsection
