@extends('layouts.app')
@section('content')
<style>
    .a:hover{
        background-color: red;
    }
</style>
<section class="section">
    <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2" style="background: #6777ef">
        <div class="p-4 m-3">
            <h1 class="text-white font-weight-600 mb-5 mt-5">Selamat Datang</h1>
            <p class="text-white" style="mb-3 mt-3">Bagi kamu yang sudah terdaftar, silakan masuk.</p>
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
            @csrf
                <div class="form-group mt-4 mb-3">
                <label for="email" style="color:white">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="youremail@example.com" required autocomplete="off" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-4 mb-5">
                    <div class="d-block">
                    <label for="password" class="control-label" style="color:white">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan Kata Sandi" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="float-right">
                        @if (Route::has('password.request'))
                        <a class="text-small" style="color:white" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-danger btn-lg btn-block" tabindex="4">
                    {{ __('Masuk') }}
                    </button>
                </div>

                <div class="mt-3 text-center text-white">
                    Belum punya akun?
                    <a href="{{ route('register') }}" style="color:white">Daftar Sekarang</a>
                </div>
            </form>
        </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 position-relative bg-white">
            <img src="{{ asset('fe/img/login.png') }}" margin-left="60px" width="90%" height="90%" alt="">
        </div>
    </div>
    </section>

@endsection
{{-- <div class="container">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand mb-3">
      </div>

      <div class="card card-primary">
          <div class="card-header">
              <h4>Login</h4>
              <img src="{{ asset('fe/img/griyokenyo.png') }}" style="background-color: white; margin-left:4em" alt="logo" width="100" class="shadow-light">
          </div>

          <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
              @csrf
              <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
              </div>
              <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Kata sandi</label>
                    <div class="float-right">
                      @if (Route::has('password.request'))
                      <a class="text-small" href="{{ route('password.request') }}">
                          {{ __('Forgot Your Password?') }}
                      </a>
                      @endif
                  </div>
                </div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
              </div>
              <div class="form-group row">
                  <div class="col-md-6">
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                          <label class="form-check-label" for="remember">
                              {{ __('Remember Me') }}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  {{ __('Masuk') }}
                </button>
              </div>
            </form>
          </div>
          <div class="mt-3 text-muted text-center">
              Belum Punya Akun? <a href="{{ route('register') }}">Klik di sini</a>
            </div>
        </div>

      </div>
    </div>
  </div>
</section> --}}
