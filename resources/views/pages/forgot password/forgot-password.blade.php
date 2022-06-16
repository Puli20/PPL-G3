@extends('layouts.login')

@section('title','Lupa Password')


@section('content')
    <div class="section-login">
        <img src="{{url('frontend/assets/img/header-bg.jpg')}}" class="img-fluid" alt="">
        <div class="login d-flex justify-content-center align-items-center flex-column">
            <h3 style="color: white" class="mb-3">Masukkan password anda yang baru</h3>
            <form method="POST" action="{{ route('forgot-password.update',$user->id) }}">
                @method('put')
                @csrf
                @if ($message = Session::get('error'))
                <div class="alert alert-warning" role="alert">
                    {{ $message }}
                  </div>
                    @endif
                <div class="mb-4">
                  <label for="exampleInputEmail1" class="form-label">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required >

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn shadow-lg" style="background-color: #C95B24; color:white">Submit</button>
                  </div>
              </form>
        </div>

    </div>
@endsection
