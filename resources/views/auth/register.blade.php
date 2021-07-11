@extends('layouts.app')

@section('content')
<section class="section">
    <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-5 col-md-6 col-12 order-lg-1 min-vh-100 order-2" style="background: #6777ef">
                <div class="text-white" style="margin-left:20px; margin-top: 40px">
                    <h1 class="text-white font-weight-600 mb-3 mt-3">Selamat Datang</h1>
                    <p class="text-white" style="mb-3 mt-3">Silakan daftar, supaya kamu dapat melakukan pemesanan</p>
                </div>

                <div class="card-body">
                <form method="POST" action="{{ route('register') }}" class="needs-validation" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name" style="color:white">Nama Lengkap</label>
                            <input id="name" type="text" placeholder="Masukkan Nama Anda" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="email" style="color:white">Email</label>
                            <input id="email" type="email" placeholder="youremail@example.com" class="form-control @error('email') is-invalid @enderror" :class="{'is_invalid' : this.email_unavailable}" name="email" value="{{ old('email') }}" required  autocomplete="off" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password" style="color:white" class="d-block">Kata Sandi</label>
                            <input id="password" placeholder="Masukkan Kata Sandi" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="password2" style="color:white" class="d-block">Konfirmasi Kata Sandi</label>
                            <input id="password-confirm" placeholder="Masukkan Kata Sandi" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                        <label for="address" style="color:white">Alamat Asal</label>
                        <input id="address" type="text" placeholder="Masukkan Alamat Asal Anda" class="form-control @error('address') is-invalid @enderror" name="address"  autocomplete="off" value="{{ old('address') }}" required autocomplete="off" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="profession" style="color:white">Pekerjaan</label>
                        <input id="profession" type="text" placeholder="Masukkan Pekerjaan Anda" class="form-control @error('profession') is-invalid @enderror" name="profession" value="{{ old('profession') }}" required  autocomplete="off" autofocus>
                            @error('profession')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="no_hp" style="color:white">No Telepon</label>
                        <input id="no_hp" type="numeric" placeholder="Masukkan Nomor Telepon Anda" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required  autocomplete="off" autofocus>
                            @error('no_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <div class="d-block">
                                <label for="photo_ktp" style="color:white" class="control-label">{{ __('Scan / Foto KTP') }}</label>
                            </div>
                            <input id="photo_ktp" type="file" class="form-control" name="photo_ktp" required>
                            @error('photo_ktp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-danger btn-lg btn-block" tabindex="4" :disabled="this.email_unavailable">
                            {{ __('Daftar') }}
                        </button>
                    </div>
                </form>
                <div class="text-white text-center">
                    Sudah Punya Akun? <a href="{{ route('login') }}" style="color:white">Masuk</a>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-12 order-lg-2 position-relative bg-white">
            <img src="{{ asset('fe/img/login.png') }}" margin-left="60px" width="90%" height="90%" alt="">
        </div>
    </div>
</section>
@endsection
