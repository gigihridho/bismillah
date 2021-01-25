@extends('layouts.app')

@section('content')
<section class="section" >
    <div class="container mt-9">
      <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
          <div class="login-brand mb-3">
            <img src="../seapalace/img/logo.png" alt="logo" width="100" class="shadow-light">
          </div>

          <div class="card card-primary">
            <div class="card-header"><h4>Daftar</h4></div>

            <div class="card-body">
              <form method="POST" action="{{ route('register') }}" class="needs-validation" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Nama Lengkap') }}</label>
                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                  </div>
                <div class="form-group">
                  <label for="email">{{ __('Email') }}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" :class="{'is_invalid' : this.email_unavailable}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                  <div class="d-block">
                      <label for="password" class="control-label">{{ __('Kata Sandi') }}</label>
                  </div>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="password-confirm" class="control-label">{{ __('Konfirmasi Kata Sandi') }}</label>
                    </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
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

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" :disabled="this.email_unavailable">
                    {{ __('Register') }}
                  </button>
                </div>
              </form>
            </div>
            <div class="mt-3 text-muted text-center">
                Sudah Punya Akun? <a href="{{ route('login') }}">Masuk</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

