@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                <img src="{{ asset('fe/img/favicon.png') }}" alt="logo" width="100" class="shadow-light rounded-circle bg-white">
            </div>

            <div class="card card-primary">
                <div class="card-header"><h4>Register</h4></div>

                <div class="card-body">
                <form method="POST" action="{{ route('register') }}" class="needs-validation" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" :class="{'is_invalid' : this.email_unavailable}" name="email" value="{{ old('email') }}"  autocomplete="off" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-6">
                        <label for="password" class="d-block">Kata Sandi</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="password2" class="d-block">Konfirmasi Kata Sandi</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                        <label for="address">Alamat Asal</label>
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"  autocomplete="off" value="{{ old('address') }}"  autocomplete="off" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="profession">Pekerjaan</label>
                        <input id="profession" type="text" class="form-control @error('profession') is-invalid @enderror" name="profession" value="{{ old('profession') }}"  autocomplete="off" autofocus>
                            @error('profession')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="no_hp">No Telepon</label>
                        <input id="no_hp" type="numeric" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}"  autocomplete="off" autofocus>
                            @error('no_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <div class="d-block">
                                <label for="photo_ktp" class="control-label">{{ __('Scan / Foto KTP') }}</label>
                            </div>
                            <input id="photo_ktp" type="file" class="form-control" name="photo_ktp" required>
                            @error('photo_ktp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" :disabled="this.email_unavailable">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
                </div>
                <div class="mt-2 text-muted text-center">
                    Sudah Punya Akun? <a href="{{ route('login') }}">Masuk</a>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
@endsection
