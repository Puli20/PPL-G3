@extends('layouts.login')

@section('title','Login')

@section('content')
    <div class="section-login">
        <img src="{{url('frontend/assets/img/header-bg.jpg')}}" class="img-fluid" alt="">
        <div class="login d-flex justify-content-center align-items-center flex-column">
            <div class="title px-2 text-center mb-3" style="color: white">
                <h3>Pesan Secangkir Kopi <br> Kian Mudah</h3>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if ($message = Session::get('error'))
                <div class="alert alert-warning" role="alert" style="font-size: 13px">
                    {{ $message }}

                  </div>
                    @endif
                <div class="mb-4">
                  <label for="exampleInputEmail1" class="form-label">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required >

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="exampleInputPassword1" class="form-label  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">Password</label>
                  <a href="{{route('forgot-password.index')}}" class="form-check-label float-end text-decoration-none" style="font-size: 12px;margin-top: 5px;color:rgb(212, 212, 212)">Lupa Password ?</a>
                  <input type="password" class="form-control" name="password" id="exampleInputPassword1">


                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn shadow-lg" style="background-color: #C95B24; color:white">Masuk</button>
                    <a href="{{route('home')}}" class="btn shadow-lg mt-2" style="background-color: #ff7373; color:white">Kembali ke Home</a>
                  </div>
              </form>
        </div>

    </div>
@endsection
