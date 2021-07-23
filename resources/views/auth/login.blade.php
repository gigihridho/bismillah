@extends('layouts.fe')
@section('title')
    Login
@endsection
@section('content')
<style>
 .form-group{
        margin-bottom: 25px;
    }
    .card .card-header h4 {
        font-size: 16px;
        line-height: 28px;
        color: #6777ef;
        padding-right: 10px;
        margin-bottom: 0;
    }

    .text-small{
        font-size: 12px;
        line-height: 20px;
    }
    a{
        color: #6777ef;
        font-weight: 500;
        -webkit-transition: all 0.5s
    }
    .btn:not(:disabled):not(.disabled){
        cursor: pointer;
    }
    .btn.btn-lg{
        padding: .75rem 1.5rem;
        font-size: 12px;
    }
    .btn-primary, .btn-primary.disabled {
    box-shadow: 0 2px 6px #acb5f6;
    background-color: #6777ef;
    border-color: #6777ef;
}
.btn {
    font-weight: 600;
    font-size: 12px;
    line-height: 24px;
    padding: 0.3rem 0.8rem;
    letter-spacing: 0.5px;
}
.btn-block{
        display: block;
        width: 100%;
    }
    .btn-group-lg>.btn, .btn-lg {
    padding: .5rem 1rem;
    font-size: 1.25rem;
    line-height: 1.5;
    border-radius: .3rem;
}
    .btn-primary {
    color: #fff;
    background-color: #6777ef;
    border-color: #6777ef;
}
</style>
<div id="app">
    <section class="section" style="background: #F7F7F7">
        <div class="container">
            <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card card-primary">
                <div class="card-header justify-content-center"><h4>Masuk Akun</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                        @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="youremail@example.com" required autocomplete="off" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Kata Sandi</label>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan Kata Sandi" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="float-right mb-3">
                                @if (Route::has('password.request'))
                                <a class="text-small" href="{{ route('password.request') }}">
                                    {{ __('Lupa Kata Sandi?') }}
                                </a>
                                @endif
                            </div>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Masuk
                        </button>
                    </div>
                    </form>
                </div>
                <div class="mb-3 text-muted text-center">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>
            </div>
            </div>
            </div>
        </div>
    </section>
</div>
{{-- <section class="section">
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
    </section> --}}

@endsection
